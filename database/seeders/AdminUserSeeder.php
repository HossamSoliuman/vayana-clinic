<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'role' => 'super_admin',
            'email' => 'admin@vayana.sa',
            'password' => Hash::make('password'),
            'first_name_en' => 'Super',
            'last_name_en' => 'Admin',
            'first_name_ar' => 'سوبر',
            'last_name_ar' => 'أدمن',
            'phone' => '0500000000',
            'locale' => 'ar',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
