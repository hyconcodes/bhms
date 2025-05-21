<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(
            ['slug' => 'doctor'],
            ['name' => 'Doctor']
        );
        Role::firstOrCreate(
            ['slug' => 'nurse'],
            ['name' => 'Nurse']
        );
        Role::firstOrCreate(
            ['slug' => 'lab_technician'],
            ['name' => 'Lab Technician']
        );
    }
}
