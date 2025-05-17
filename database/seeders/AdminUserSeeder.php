<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user if it doesn't exist
        if (!User::where('email', 'superadmin@example.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPER_ADMIN,
            ]);
        }
        
        // Create finance admin user if it doesn't exist
        if (!User::where('email', 'finance@example.com')->exists()) {
            User::create([
                'name' => 'Admin Keuangan',
                'email' => 'finance@example.com',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN_KEUANGAN,
            ]);
        }
    }
}
