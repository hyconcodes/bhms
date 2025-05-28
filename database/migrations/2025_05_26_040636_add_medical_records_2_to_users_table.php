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
        Schema::table('users', function (Blueprint $table) {
            $table->string('reg_no')->unique()->after('email')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('state_of_domicile')->nullable();
            $table->string('faculty')->nullable();
            $table->enum('heart_disease', ['Yes', 'No'])->nullable();
            $table->enum('respiratory_disease', ['Yes', 'No'])->nullable();
            $table->enum('tuberculosis', ['Yes', 'No'])->nullable();
            $table->enum('stomach_disorder', ['Yes', 'No'])->nullable();
            $table->enum('mental_disorder', ['Yes', 'No'])->nullable();
            $table->enum('gonorrhea', ['Yes', 'No'])->nullable();
            $table->enum('syphilis', ['Yes', 'No'])->nullable();
            $table->enum('epilepsy', ['Yes', 'No'])->nullable();
            $table->enum('sickle_cell', ['Yes', 'No'])->nullable();
            $table->text('previous_operations')->nullable();
            $table->text('other_illnesses')->nullable();
            $table->string('vital_signs_bp')->nullable();
            $table->integer('vital_signs_rr')->nullable();
            $table->integer('vital_signs_pr')->nullable();
            $table->string('chest_xray')->nullable();
            $table->string('hb_genotype')->nullable();
            $table->string('urine_analysis')->nullable();
            $table->text('other_lab_tests')->nullable();
            $table->string('eye_test')->nullable();
            $table->string('ent_test')->nullable();
            $table->string('reflex_test')->nullable();
            $table->enum('pregnancy_status', ['Yes', 'No'])->nullable();
            $table->text('general_fitness')->nullable();
            // $table->string('medical_officer_name');
            // $table->text('medical_officer_signature')->nullable();
            // $table->date('exam_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'reg_no',
                'state_of_origin',
                'state_of_domicile',
                'faculty',
                'heart_disease',
                'respiratory_disease',
                'tuberculosis',
                'stomach_disorder',
                'mental_disorder',
                'gonorrhea',
                'syphilis',
                'epilepsy',
                'sickle_cell',
                'previous_operations',
                'other_illnesses',
                'vital_signs_bp',
                'vital_signs_rr',
                'vital_signs_pr',
                'chest_xray',
                'hb_genotype',
                'urine_analysis',
                'other_lab_tests',
                'eye_test',
                'ent_test',
                'reflex_test',
                'pregnancy_status',
                'general_fitness'
            ]);
            // $table->dropColumn(['medical_officer_name', 'medical_officer_signature', 'exam_date']);
        });
    }
};
