<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $query = ProviderProfile::with('user');

        if ($request->filled('status')) {
            if ($request->status === 'verified') {
                $query->verified();
            } elseif ($request->status === 'pending') {
                $query->where('is_verified', false);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name_en', 'like', "%{$search}%")
                  ->orWhere('last_name_en', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $providers = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.providers.index', compact('providers'));
    }

    public function show(ProviderProfile $provider)
    {
        $provider->load('user', 'specialties', 'languages', 'availabilities');
        return view('admin.providers.show', compact('provider'));
    }

    public function verify(ProviderProfile $provider)
    {
        $provider->update(['is_verified' => true]);
        return back()->with('success', __('messages.provider_verified'));
    }

    public function toggleFeatured(ProviderProfile $provider)
    {
        $provider->update(['is_featured' => !$provider->is_featured]);
        return back()->with('success', __('messages.provider_featured_updated'));
    }
}
