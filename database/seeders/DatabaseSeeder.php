<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SpecialtiesSeeder::class,
            ResourceCategoriesSeeder::class,
            ServicesSeeder::class,
            FaqSeeder::class,
            JournalPromptsSeeder::class,
            SiteSettingsSeeder::class,
            PartnersSeeder::class,
        ]);
    }
}
