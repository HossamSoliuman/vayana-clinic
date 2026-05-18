<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'Ministry of Health', 'display_order' => 1],
            ['name' => 'Saudi Business Center', 'display_order' => 2],
            ['name' => 'Seha', 'display_order' => 3],
            ['name' => 'Saudi Commission for Health Specialties', 'display_order' => 4],
        ];

        foreach ($partners as $p) {
            Partner::create($p);
        }
    }
}
