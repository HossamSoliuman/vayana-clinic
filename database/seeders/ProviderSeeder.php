<?php

namespace Database\Seeders;

use App\Models\ProviderProfile;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = Specialty::pluck('id', 'slug')->toArray();

        $providers = [
            [
                'name_en' => 'Dr. Sarah Johnson',
                'name_ar' => 'د. سارة جونسون',
                'email' => 'sarah.johnson@provider.com',
                'title' => 'Dr',
                'biography_en' => 'Experienced clinical psychologist with 10+ years in therapy and counseling. Specializes in anxiety disorders and trauma therapy.',
                'biography_ar' => 'معالجة نفسية سريرية ذات خبرة تزيد عن 10 سنوات في العلاج والاستشارة. متخصصة في اضطرابات القلق والعلاج من الصدمات.',
                'years_of_experience' => 10,
                'session_price_online' => 75.00,
                'session_price_inperson' => 100.00,
                'work_type' => 'online',
                'is_verified' => true,
                'is_featured' => true,
                'is_available' => true,
                'license_number' => 'PSY001',
                'specialties' => ['anxiety', 'trauma'],
                'languages' => ['english', 'arabic'],
            ],
            [
                'name_en' => 'Dr. Ahmed Hassan',
                'name_ar' => 'د. أحمد حسن',
                'email' => 'ahmed.hassan@provider.com',
                'title' => 'Dr',
                'biography_en' => 'Certified therapist with expertise in depression, stress management, and family counseling. Fluent in English and Arabic.',
                'biography_ar' => 'معالج معتمد متخصص في الاكتئاب وإدارة التوتر والاستشارة العائلية. طليق في اللغة الإنجليزية والعربية.',
                'years_of_experience' => 8,
                'session_price_online' => 60.00,
                'session_price_inperson' => 85.00,
                'work_type' => 'hybrid',
                'is_verified' => true,
                'is_featured' => false,
                'is_available' => true,
                'license_number' => 'THR002',
                'specialties' => ['depression', 'stress', 'family-issues'],
                'languages' => ['english', 'arabic'],
            ],
            [
                'name_en' => 'Dr. Amelia Smith',
                'name_ar' => 'د. أميليا سميث',
                'email' => 'amelia.smith@provider.com',
                'title' => 'Dr',
                'biography_en' => 'Specialized in CBT with 7 years of clinical experience. Expertise in OCD, anxiety, and behavioral disorders.',
                'biography_ar' => 'متخصص في العلاج السلوكي المعرفي بخبرة سريرية 7 سنوات. متخصص في الوسواس القهري والقلق والاضطرابات السلوكية.',
                'years_of_experience' => 7,
                'session_price_online' => 80.00,
                'session_price_inperson' => 110.00,
                'work_type' => 'online',
                'is_verified' => true,
                'is_featured' => false,
                'is_available' => true,
                'license_number' => 'CBT003',
                'specialties' => ['ocd', 'anxiety'],
                'languages' => ['english'],
            ],
            [
                'name_en' => 'Dr. Mohammad Ali',
                'name_ar' => 'د. محمد علي',
                'email' => 'mohammad.ali@provider.com',
                'title' => 'Dr',
                'biography_en' => 'Compassionate counselor with 5 years of experience in grief support and life transitions. Specializes in anger management.',
                'biography_ar' => 'مستشار رحيم بخبرة 5 سنوات في دعم الحزن والانتقالات الحياتية. متخصص في التحكم بالغضب.',
                'years_of_experience' => 5,
                'session_price_online' => 50.00,
                'session_price_inperson' => 70.00,
                'work_type' => 'hybrid',
                'is_verified' => true,
                'is_featured' => false,
                'is_available' => true,
                'license_number' => 'MHC004',
                'specialties' => ['grief', 'anger-management'],
                'languages' => ['arabic', 'english'],
            ],
            [
                'name_en' => 'Dr. Lisa Wilson',
                'name_ar' => 'د. ليزا ويلسون',
                'email' => 'lisa.wilson@provider.com',
                'title' => 'Dr',
                'biography_en' => 'Expert in trauma therapy and PTSD treatment. 12 years of experience with individuals and groups. Bilingual professional.',
                'biography_ar' => 'خبير في العلاج من الصدمات وعلاج اضطراب ما بعد الصدمة. 12 سنة خبرة مع الأفراد والمجموعات. متخصص ثنائي اللغة.',
                'years_of_experience' => 12,
                'session_price_online' => 90.00,
                'session_price_inperson' => 120.00,
                'work_type' => 'hybrid',
                'is_verified' => true,
                'is_featured' => true,
                'is_available' => true,
                'license_number' => 'CLT005',
                'specialties' => ['trauma', 'ptsd', 'anxiety'],
                'languages' => ['english', 'arabic'],
            ],
        ];

        foreach ($providers as $providerData) {
            $specialties_list = $providerData['specialties'];
            $languages = $providerData['languages'];
            unset($providerData['specialties'], $providerData['languages']);

            $user = User::create([
                'role' => 'provider',
                'email' => $providerData['email'],
                'password' => bcrypt('password'),
                'first_name_en' => explode(' ', $providerData['name_en'])[0],
                'last_name_en' => explode(' ', $providerData['name_en'])[1] ?? '',
                'first_name_ar' => explode(' ', $providerData['name_ar'])[0],
                'last_name_ar' => explode(' ', $providerData['name_ar'])[1] ?? '',
                'is_active' => true,
            ]);

            unset($providerData['name_en'], $providerData['name_ar'], $providerData['email']);

            $provider = ProviderProfile::create(array_merge($providerData, ['user_id' => $user->id]));

            foreach ($specialties_list as $specialty) {
                if (isset($specialties[$specialty])) {
                    $provider->specialties()->attach($specialties[$specialty]);
                }
            }

            foreach ($languages as $language) {
                $provider->languages()->create(['language' => $language]);
            }
        }
    }
}
