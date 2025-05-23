<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Olalekan Olamide',
            'email' => 'olamide@mail.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // 4 is the role ID for 'super admin'
            'gender' => 'male',
            'avatar' => 'https://api.dicebear.com/9.x/adventurer/svg?seed=Olamide&radius=50',
        ]);
    }
}
