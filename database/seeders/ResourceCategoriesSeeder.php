<?php

namespace Database\Seeders;

use App\Models\ResourceCategory;
use Illuminate\Database\Seeder;

class ResourceCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_en' => 'Blog Articles', 'name_ar' => 'مقالات المدونة', 'slug' => 'blog-articles'],
            ['name_en' => 'Audio', 'name_ar' => 'صوتيات', 'slug' => 'audio'],
            ['name_en' => 'Self-Help eBooks', 'name_ar' => 'كتب مساعدة ذاتية', 'slug' => 'self-help-ebooks'],
            ['name_en' => 'Video', 'name_ar' => 'فيديو', 'slug' => 'video'],
            ['name_en' => 'Guided Meditation', 'name_ar' => 'تأمل موجه', 'slug' => 'guided-meditation'],
            ['name_en' => 'Mental Health Conversations', 'name_ar' => 'حوارات الصحة النفسية', 'slug' => 'mental-health-conversations'],
            ['name_en' => 'Assessments', 'name_ar' => 'تقييمات', 'slug' => 'assessments'],
        ];

        foreach ($categories as $c) {
            ResourceCategory::create($c);
        }
    }
}
