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
            $table->string('genotype')->nullable()->after('email');
            $table->string('religion')->nullable()->after('genotype');
            $table->string('nationality')->nullable()->after('religion');
            $table->string('marital_status')->nullable()->after('nationality');
            $table->string('disability')->nullable()->after('blood_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('genotype');
            $table->dropColumn('religion');
            $table->dropColumn('nationality');
            $table->dropColumn('marital_status');
            $table->dropColumn('disability');
        });
    }
};
