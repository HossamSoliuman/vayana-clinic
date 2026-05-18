<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name_en' => 'Individual Therapy',
                'name_ar' => 'العلاج الفردي',
                'slug' => 'individual-therapy',
                'description_en' => 'One-on-one sessions with a licensed therapist to address personal mental health concerns.',
                'description_ar' => 'جلسات فردية مع أخصائي مرخص لمعالجة القلق النفسي الشخصي.',
                'icon' => 'bi bi-person',
                'display_order' => 1,
            ],
            [
                'name_en' => 'Family Therapy',
                'name_ar' => 'العلاج العائلي',
                'slug' => 'family-therapy',
                'description_en' => 'Therapy sessions designed to help families improve communication and resolve conflicts.',
                'description_ar' => 'جلسات علاجية مصممة لمساعدة الأسر على تحسين التواصل وحل النزاعات.',
                'icon' => 'bi bi-people',
                'display_order' => 2,
            ],
            [
                'name_en' => 'Psychiatric Services',
                'name_ar' => 'الخدمات النفسية',
                'slug' => 'psychiatric-services',
                'description_en' => 'Psychiatric evaluation and medication management by board-certified psychiatrists.',
                'description_ar' => 'التقييم النفسي وإدارة الأدوية من قبل أطباء نفسيين معتمدين.',
                'icon' => 'bi bi-heart-pulse',
                'display_order' => 3,
            ],
            [
                'name_en' => 'Therapy Programs',
                'name_ar' => 'برامج العلاج',
                'slug' => 'therapy-programs',
                'description_en' => 'Structured group and individual therapy programs for specific mental health conditions.',
                'description_ar' => 'برامج علاج جماعية وفردية منظمة لحالات الصحة النفسية المحددة.',
                'icon' => 'bi bi-journal-medical',
                'display_order' => 4,
            ],
        ];

        foreach ($services as $s) {
            Service::create($s);
        }
    }
}
