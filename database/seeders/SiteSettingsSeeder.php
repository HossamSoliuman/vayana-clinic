<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name_en', 'value' => 'Vayana', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'site_name_ar', 'value' => 'وايانا', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'contact_email', 'value' => 'info@vayana.sa', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'contact_phone', 'value' => '920012345', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'whatsapp_number', 'value' => '966500000000', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'clinic_address_en', 'value' => 'Riyadh, Saudi Arabia', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'clinic_address_ar', 'value' => 'الرياض، المملكة العربية السعودية', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'clinic_hours_en', 'value' => 'Sun-Thu: 9:00 AM - 9:00 PM', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'clinic_hours_ar', 'value' => 'الأحد-الخميس: ٩:٠٠ ص - ٩:٠٠ م', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'google_play_link', 'value' => '', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'app_store_link', 'value' => '', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'footer_description_en', 'value' => 'Your trusted mental health and wellness platform in Saudi Arabia.', 'type' => 'text', 'group' => 'general', 'is_public' => true],
            ['key' => 'footer_description_ar', 'value' => 'منصتك الموثوقة للصحة النفسية والعافية في المملكة العربية السعودية.', 'type' => 'text', 'group' => 'general', 'is_public' => true],
            ['key' => 'social_facebook', 'value' => '', 'type' => 'string', 'group' => 'social', 'is_public' => true],
            ['key' => 'social_instagram', 'value' => '', 'type' => 'string', 'group' => 'social', 'is_public' => true],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'string', 'group' => 'social', 'is_public' => true],
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'string', 'group' => 'social', 'is_public' => true],
            ['key' => 'social_tiktok', 'value' => '', 'type' => 'string', 'group' => 'social', 'is_public' => true],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'string', 'group' => 'social', 'is_public' => true],
            ['key' => 'seo_default_title_en', 'value' => 'Vayana - Mental Health & Wellness Platform', 'type' => 'string', 'group' => 'seo', 'is_public' => true],
            ['key' => 'seo_default_title_ar', 'value' => 'وايانا - منصة الصحة النفسية والعافية', 'type' => 'string', 'group' => 'seo', 'is_public' => true],
            ['key' => 'seo_default_description_en', 'value' => 'Vayana connects you with certified mental health professionals in Saudi Arabia.', 'type' => 'text', 'group' => 'seo', 'is_public' => true],
            ['key' => 'seo_default_description_ar', 'value' => 'وايانا تربطك بأخصائيي الصحة النفسية المعتمدين في المملكة العربية السعودية.', 'type' => 'text', 'group' => 'seo', 'is_public' => true],
        ];

        foreach ($settings as $s) {
            SiteSetting::create($s);
        }
    }
}
