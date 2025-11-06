<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'General Manager',
            'email' => 'generalmanager@example.com',
            'role' => 'generalmanager',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'Senior Manager',
            'email' => 'seniormanager@example.com',
            'role' => 'seniormanager',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'role' => 'manager',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}
