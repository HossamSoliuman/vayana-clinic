<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderProfile;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        $specialties = Specialty::active()->get();

        return view('admin.providers.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'first_name_en' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'first_name_ar' => 'nullable|string|max:255',
            'last_name_ar' => 'nullable|string|max:255',
            'title' => 'required|in:Dr,Mr,Ms,Mrs',
            'license_number' => 'required|string|unique:provider_profiles',
            'biography_en' => 'required|string',
            'biography_ar' => 'nullable|string',
            'years_of_experience' => 'required|integer|min:0|max:70',
            'session_price_online' => 'required|numeric|min:0|max:9999.99',
            'session_price_inperson' => 'required|numeric|min:0|max:9999.99',
            'work_type' => 'required|in:online,in_person,hybrid',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialties' => 'required|array|min:1',
            'specialties.*' => 'exists:specialties,id',
            'languages' => 'required|array|min:1',
            'languages.*' => 'in:arabic,english,french,other',
            'is_verified' => 'boolean',
            'is_available' => 'boolean',
        ]);

        $user = User::create([
            'role' => 'provider',
            'email' => $validated['email'],
            'password' => bcrypt('password'),
            'first_name_en' => $validated['first_name_en'],
            'last_name_en' => $validated['last_name_en'],
            'first_name_ar' => $validated['first_name_ar'] ?? $validated['first_name_en'],
            'last_name_ar' => $validated['last_name_ar'] ?? $validated['last_name_en'],
            'is_active' => true,
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('providers', 'public');
        }

        $provider = ProviderProfile::create([
            'user_id' => $user->id,
            'photo_path' => $photoPath,
            'title' => $validated['title'],
            'biography_en' => $validated['biography_en'],
            'biography_ar' => $validated['biography_ar'] ?? $validated['biography_en'],
            'license_number' => $validated['license_number'],
            'years_of_experience' => $validated['years_of_experience'],
            'session_price_online' => $validated['session_price_online'],
            'session_price_inperson' => $validated['session_price_inperson'],
            'currency' => 'USD',
            'work_type' => $validated['work_type'],
            'is_verified' => $validated['is_verified'] ?? false,
            'is_available' => $validated['is_available'] ?? true,
            'application_status' => 'approved',
        ]);

        $provider->specialties()->sync($validated['specialties']);

        foreach ($validated['languages'] as $language) {
            $provider->languages()->create(['language' => $language]);
        }

        return redirect()->route('admin.providers.show', $provider)
            ->with('success', __('messages.provider_created_successfully'));
    }

    public function show(ProviderProfile $provider)
    {
        $provider->load('user', 'specialties', 'languages', 'availabilities');

        return view('admin.providers.show', compact('provider'));
    }

    public function edit(ProviderProfile $provider)
    {
        $provider->load('user', 'specialties', 'languages');
        $specialties = Specialty::active()->get();

        return view('admin.providers.edit', compact('provider', 'specialties'));
    }

    public function update(Request $request, ProviderProfile $provider)
    {
        $validated = $request->validate([
            'first_name_en' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'first_name_ar' => 'nullable|string|max:255',
            'last_name_ar' => 'nullable|string|max:255',
            'title' => 'required|in:Dr,Mr,Ms,Mrs',
            'biography_en' => 'required|string',
            'biography_ar' => 'nullable|string',
            'years_of_experience' => 'required|integer|min:0|max:70',
            'session_price_online' => 'required|numeric|min:0|max:9999.99',
            'session_price_inperson' => 'required|numeric|min:0|max:9999.99',
            'work_type' => 'required|in:online,in_person,hybrid',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialties' => 'required|array|min:1',
            'specialties.*' => 'exists:specialties,id',
            'languages' => 'required|array|min:1',
            'languages.*' => 'in:arabic,english,french,other',
            'is_verified' => 'boolean',
            'is_available' => 'boolean',
        ]);

        $provider->update([
            'title' => $validated['title'],
            'biography_en' => $validated['biography_en'],
            'biography_ar' => $validated['biography_ar'] ?? $validated['biography_en'],
            'years_of_experience' => $validated['years_of_experience'],
            'session_price_online' => $validated['session_price_online'],
            'session_price_inperson' => $validated['session_price_inperson'],
            'work_type' => $validated['work_type'],
            'is_verified' => $validated['is_verified'] ?? false,
            'is_available' => $validated['is_available'] ?? true,
        ]);

        if ($request->hasFile('photo')) {
            if ($provider->photo_path && Storage::disk('public')->exists($provider->photo_path)) {
                Storage::disk('public')->delete($provider->photo_path);
            }
            $photoPath = $request->file('photo')->store('providers', 'public');
            $provider->update(['photo_path' => $photoPath]);
        }

        $provider->user()->update([
            'first_name_en' => $validated['first_name_en'],
            'last_name_en' => $validated['last_name_en'],
            'first_name_ar' => $validated['first_name_ar'] ?? $validated['first_name_en'],
            'last_name_ar' => $validated['last_name_ar'] ?? $validated['last_name_en'],
        ]);

        $provider->specialties()->sync($validated['specialties']);
        $provider->languages()->delete();

        foreach ($validated['languages'] as $language) {
            $provider->languages()->create(['language' => $language]);
        }

        return redirect()->route('admin.providers.show', $provider)
            ->with('success', __('messages.provider_updated'));
    }

    public function verify(ProviderProfile $provider)
    {
        $provider->update(['is_verified' => true]);

        return back()->with('success', __('messages.provider_verified'));
    }

    public function toggleFeatured(ProviderProfile $provider)
    {
        $provider->update(['is_featured' => ! $provider->is_featured]);

        return back()->with('success', __('messages.provider_featured_updated'));
    }
}
