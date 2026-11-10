<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@donikdonuts.com'],
            [
                'name'      => 'Admin Donik Donuts',
                'password'  => Hash::make('admin123'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'kasir@donuts.com'],
            [
                'name'      => 'Kasir 1',
                'password'  => Hash::make('donuts123'),
                'role'      => 'kasir',
                'is_active' => true,
            ]
        );
    }
}
