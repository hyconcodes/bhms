<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->enum('appointment_urgency', [
                'Not Urgent - Routine checkup',
                'Mild - Minor discomfort',
                'Moderate - Noticeable symptoms',
                'Urgent - Significant pain/symptoms',
                'Very Urgent - Severe condition',
                'Emergency - Immediate attention needed'
            ]);
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'completed', 'cancelled'])->default('pending');
            $table->text('comment')->nullable();
            $table->text('prescription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
