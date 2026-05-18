<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        $groups = ['general', 'contact', 'social', 'seo'];
        return view('admin.settings.index', compact('settings', 'groups'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $type = is_bool($value) ? 'boolean' : (is_array($value) ? 'json' : 'string');
            $castedValue = $type === 'json' ? json_encode($value) : $value;

            $group = 'general';
            if (str_starts_with($key, 'contact_') || str_starts_with($key, 'clinic_') || str_starts_with($key, 'whatsapp_')) {
                $group = 'contact';
            } elseif (str_starts_with($key, 'social_')) {
                $group = 'social';
            } elseif (str_starts_with($key, 'seo_')) {
                $group = 'seo';
            }

            SiteSetting::set($key, $castedValue, $type, $group);
        }

        return back()->with('success', __('messages.settings_updated'));
    }
}
