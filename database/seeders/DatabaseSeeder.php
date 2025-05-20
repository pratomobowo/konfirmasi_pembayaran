<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Call the AdminUserSeeder to create admin users
        $this->call([
            AdminUserSeeder::class,
            PaymentTypeSeeder::class,
            SettingSeeder::class,
            EmailTemplateSeeder::class,
        ]);
    }
}
