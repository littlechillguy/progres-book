<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'rasya@probook.com'
            ],
            [
                'name' => 'Rasya',
                'password' => Hash::make('rasya123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'dzakwan@probook.com'
            ],
            [
                'name' => 'Dzakwan',
                'password' => Hash::make('dzakwan123'),
                'role' => 'admin',
            ]
        );
    }
}