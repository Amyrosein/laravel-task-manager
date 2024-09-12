<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Manager',
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('admin'),
            'email_verified_at' => now(),
            'is_admin'          => true,
        ]);

        User::create([
            'name'              => 'Normal User',
            'email'             => 'user@user.com',
            'password'          => Hash::make('user'),
            'email_verified_at' => now(),
        ]);
    }
}
