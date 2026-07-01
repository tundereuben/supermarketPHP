<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@supermarket.test',
            'password' => Hash::make('password'),
            'phone' => '+234 800 000 0000',
            'address' => 'Admin Office',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test Customer',
            'email' => 'user@supermarket.test',
            'password' => Hash::make('password'),
            'phone' => '+234 801 234 5678',
            'address' => '123 Main Street',
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);
    }
}
