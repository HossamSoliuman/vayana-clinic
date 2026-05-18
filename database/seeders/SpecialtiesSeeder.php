<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name_en' => 'Depression', 'name_ar' => 'الاكتئاب', 'slug' => 'depression'],
            ['name_en' => 'Anxiety', 'name_ar' => 'القلق', 'slug' => 'anxiety'],
            ['name_en' => 'Trauma', 'name_ar' => 'الصدمة', 'slug' => 'trauma'],
            ['name_en' => 'Stress', 'name_ar' => 'التوتر', 'slug' => 'stress'],
            ['name_en' => 'Family Issues', 'name_ar' => 'مشاكل عائلية', 'slug' => 'family-issues'],
            ['name_en' => 'Addiction', 'name_ar' => 'الإدمان', 'slug' => 'addiction'],
            ['name_en' => 'OCD', 'name_ar' => 'الوسواس القهري', 'slug' => 'ocd'],
            ['name_en' => 'PTSD', 'name_ar' => 'اضطراب ما بعد الصدمة', 'slug' => 'ptsd'],
            ['name_en' => 'Grief', 'name_ar' => 'الحزن', 'slug' => 'grief'],
            ['name_en' => 'Anger Management', 'name_ar' => 'التحكم في الغضب', 'slug' => 'anger-management'],
            ['name_en' => 'Self-Esteem', 'name_ar' => 'تقدير الذات', 'slug' => 'self-esteem'],
            ['name_en' => 'Relationship Issues', 'name_ar' => 'مشاكل العلاقات', 'slug' => 'relationship-issues'],
        ];

        foreach ($specialties as $s) {
            Specialty::create($s);
        }
    }
}
