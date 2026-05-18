<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $query = Workshop::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $workshops = $query->orderBy('date_time', 'desc')->paginate(20);
        return view('admin.workshops.index', compact('workshops'));
    }

    public function create()
    {
        return view('admin.workshops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:workshops',
            'description_en' => 'required|string',
            'description_ar' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instructor_name' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'date_time' => 'nullable|date',
            'location' => 'required|in:online,in_person,hybrid',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|in:SAR,USD',
            'max_participants' => 'nullable|integer',
            'registration_link' => 'nullable|url|max:255',
            'is_registration_open' => 'nullable|boolean',
            'category' => 'required|in:wellness,resilience,stress_management,confidence,workplace,other',
            'display_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_en']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_registration_open'] = $request->boolean('is_registration_open', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('workshops', 'public');
        }

        Workshop::create($validated);

        return redirect()->route('admin.workshops.index')->with('success', __('messages.workshop_created'));
    }

    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:workshops,slug,' . $workshop->id,
            'description_en' => 'required|string',
            'description_ar' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instructor_name' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'date_time' => 'nullable|date',
            'location' => 'required|in:online,in_person,hybrid',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|in:SAR,USD',
            'max_participants' => 'nullable|integer',
            'registration_link' => 'nullable|url|max:255',
            'is_registration_open' => 'nullable|boolean',
            'category' => 'required|in:wellness,resilience,stress_management,confidence,workplace,other',
            'display_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['is_registration_open'] = $request->boolean('is_registration_open', false);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('workshops', 'public');
        }

        $workshop->update($validated);

        return redirect()->route('admin.workshops.index')->with('success', __('messages.workshop_updated'));
    }

    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('admin.workshops.index')->with('success', __('messages.workshop_deleted'));
    }
}
