<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question_en' => 'What is Vayana?',
                'question_ar' => 'ما هي وايانا؟',
                'answer_en' => 'Vayana is a licensed bilingual mental health and wellness platform recognized by the Saudi Ministry of Health.',
                'answer_ar' => 'وايانا هي منصة مرخصة ثنائية اللغة للصحة النفسية والعافية معترف بها من قبل وزارة الصحة السعودية.',
                'category' => 'general',
            ],
            [
                'question_en' => 'How do I book a therapy session?',
                'question_ar' => 'كيف أحجز جلسة علاج؟',
                'answer_en' => 'You can book a session by visiting our Providers page, selecting a therapist, and clicking Book Appointment.',
                'answer_ar' => 'يمكنك حجز جلسة من خلال زيارة صفحة الأخصائيين واختيار المعالج والضغط على حجز موعد.',
                'category' => 'appointments',
            ],
            [
                'question_en' => 'Are the therapists licensed?',
                'question_ar' => 'هل الأخصائيون مرخصون؟',
                'answer_en' => 'Yes, all therapists on our platform are licensed and verified by our team.',
                'answer_ar' => 'نعم، جميع الأخصائيين على منصتنا مرخصين وموثقين من قبل فريقنا.',
                'category' => 'providers',
            ],
            [
                'question_en' => 'What payment methods do you accept?',
                'question_ar' => 'ما هي طرق الدفع التي تقبلونها؟',
                'answer_en' => 'We accept online payments via credit/debit cards and bank transfers.',
                'answer_ar' => 'نقبل المدفوعات الإلكترونية عبر البطاقات الائتمانية/الخصم والتحويلات البنكية.',
                'category' => 'billing',
            ],
            [
                'question_en' => 'Do you offer corporate wellness programs?',
                'question_ar' => 'هل تقدمون برامج عافية للشركات؟',
                'answer_en' => 'Yes, we offer EAPs, training workshops, and awareness campaigns for organizations.',
                'answer_ar' => 'نعم، نقدم برامج مساعدة الموظفين وورش عمل تدريبية وحملات توعية للمؤسسات.',
                'category' => 'business',
            ],
        ];

        foreach ($faqs as $f) {
            Faq::create($f);
        }
    }
}
