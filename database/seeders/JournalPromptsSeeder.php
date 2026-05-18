<?php

namespace Database\Seeders;

use App\Models\JournalPrompt;
use Illuminate\Database\Seeder;

class JournalPromptsSeeder extends Seeder
{
    public function run(): void
    {
        $prompts = [
            ['prompt_text_en' => 'What are three things you are grateful for today?', 'prompt_text_ar' => 'ما هي ثلاثة أشياء تشكر عليها اليوم؟', 'category' => 'gratitude'],
            ['prompt_text_en' => 'Describe a moment that made you smile today.', 'prompt_text_ar' => 'صف لحظة جعلتك تبتسم اليوم.', 'category' => 'gratitude'],
            ['prompt_text_en' => 'What challenged you today and how did you handle it?', 'prompt_text_ar' => 'ما الذي تحداك اليوم وكيف تعاملت معه؟', 'category' => 'reflection'],
            ['prompt_text_en' => 'Write about a goal you want to achieve this month.', 'prompt_text_ar' => 'اكتب عن هدف تريد تحقيقه هذا الشهر.', 'category' => 'goal_setting'],
            ['prompt_text_en' => 'How are you feeling right now? Describe it in detail.', 'prompt_text_ar' => 'كيف تشعر الآن؟ صف ذلك بالتفصيل.', 'category' => 'emotion'],
            ['prompt_text_en' => 'Take a deep breath and write about what you notice in your body.', 'prompt_text_ar' => 'خذ نفساً عميقاً واكتب عن ما تلاحظه في جسدك.', 'category' => 'mindfulness'],
        ];

        foreach ($prompts as $p) {
            JournalPrompt::create($p);
        }
    }
}
