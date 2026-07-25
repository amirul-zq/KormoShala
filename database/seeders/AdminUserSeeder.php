<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kormoshala.com'],
            [
                'name' => 'KormoShala Admin',
                'password' => Hash::make('Admin123!'),
                'whatsapp_number' => '01700000000',
                'address' => 'Bangladesh',
                'role' => 'admin',
                'status' => 'active',
            ]
        );
    }
}