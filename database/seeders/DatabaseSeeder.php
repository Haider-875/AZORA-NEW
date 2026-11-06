<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@azorasolution.com');
        $adminPassword = env('ADMIN_PASSWORD', 'AzoraAdmin2026!');

        User::firstOrCreate(
            ['email' => strtolower($adminEmail)],
            [
                'name' => 'Azora Administrator',
                'password' => Hash::make($adminPassword),
            ]
        );
    }
}
