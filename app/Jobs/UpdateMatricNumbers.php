<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateMatricNumbers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $allStudentRegNo;
    protected $apiUrl;

    /**
     * Create a new job instance.
     */
    public function __construct($allStudentRegNo, $apiUrl)
    {
        $this->allStudentRegNo = $allStudentRegNo;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (empty($this->apiUrl)) {
            Log::error("API URL is not configured");
            return;
        }

        Log::info("Started updating matric numbers for students.");

        foreach ($this->allStudentRegNo as $regNo) {
            try {
                // Ensure reg_no is not empty
                if (empty($regNo)) {
                    Log::warning("Empty registration number encountered, skipping...");
                    continue;
                }

                $response = Http::retry(3, 5000)
                    ->timeout(30)
                    ->get("{$this->apiUrl}/jamb_no/{$regNo}");

                $responseData = $response->json();

                if ($response->successful() && isset($responseData['matric'])) {
                    // Log the successful response
                    Log::info("Received matric for reg no {$regNo}: {$responseData['matric']}");

                    // Find the user first
                    $user = User::where('reg_no', $regNo)->first();

                    if ($user) {
                        // Update using the model instance
                        $user->matric = $responseData['matric'];
                        $updated = $user->save();

                        // Log the result of the update
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

                // Add a small delay between requests to prevent overwhelming the API
                usleep(500000); // 0.5 second delay

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
    }
}
