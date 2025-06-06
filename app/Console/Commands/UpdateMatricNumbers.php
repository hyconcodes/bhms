<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class UpdateMatricNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:matric';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates matric numbers for students from an external API.';

    private $apiUrl;
    private $allStudentRegNo;

    public function __construct()
    {
        parent::__construct();

        // Set up any dependencies, API URL, or data here
        $this->apiUrl = Setting::first()?->api_url; // Assuming your API URL is in config/services.php
        $this->allStudentRegNo = User::whereHas('role', fn($query) => $query->where('name', 'student'))->pluck('reg_no'); // Example to fetch all reg_no
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // log something to the console
        Log::info("Updating matric numbers for students...");
        if (empty($this->apiUrl)) {
            Log::error("API URL is not configured");
            return Command::FAILURE;
        }

        Log::info("Started updating matric numbers for students.");

        foreach ($this->allStudentRegNo as $regNo) {
            try {
                if (empty($regNo)) {
                    Log::warning("Empty registration number encountered, skipping...");
                    continue;
                }

                $response = Http::retry(3, 5000)
                    ->timeout(30)
                    ->get("{$this->apiUrl}/jamb_no/{$regNo}");

                $responseData = $response->json();
                // lets log the response
                // Log::info("Response for reg no {$regNo}: " . json_encode($responseData));

                if ($response->successful() && isset($responseData['data']['matric'])) {
                    Log::info("Received matric for reg no {$regNo}: {$responseData['data']['matric']}");

                    $user = User::where('reg_no', $regNo)->first();

                    if ($user) {
                        $user->matric = $responseData['data']['matric'];
                        $updated = $user->save();

                        if ($updated) {
                            Log::info("Matric updated successfully for reg no {$regNo}");
                        } else {
                            Log::warning("Failed to update matric for reg no {$regNo}");
                        }
                    } else {
                        Log::warning("User not found in database for reg no {$regNo}");
                    }
                } elseif (!$response->successful()) {
                    Log::warning("Failed API call for reg no {$regNo}: " . $response->status() . " - Response: " . json_encode($responseData));
                } else {
                    Log::warning("Matric field not found in response for reg no {$regNo}. Response: " . json_encode($responseData));
                }

                usleep(500000);
            } catch (\Illuminate\Http\Client\RequestException $e) {
                if ($e->getCode() === 404) {
                    Log::notice("Student not found for reg no {$regNo}: " . $e->getMessage());
                } else {
                    Log::error("Error updating matric for reg no {$regNo}: " . $e->getMessage(), [
                        'url' => "{$this->apiUrl}/jamb_no/{$regNo}",
                        'trace' => $e->getTraceAsString(),
                        'response' => $e->response?->body(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error("Unexpected error for reg no {$regNo}: " . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        Log::info("Finished updating matric numbers for students.");
        return Command::SUCCESS;
    }
}
