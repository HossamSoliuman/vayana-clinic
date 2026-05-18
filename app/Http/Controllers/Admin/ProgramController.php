<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderProfile;
use App\Models\Service;
use App\Models\TherapyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = TherapyProgram::with('service')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $services = Service::active()->get();
        $providers = ProviderProfile::verified()->with('user')->get();
        return view('admin.programs.create', compact('services', 'providers'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProgram($request);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['what_you_will_learn_en'] = $this->parseJsonArray($request->what_you_will_learn_en);
        $validated['what_you_will_learn_ar'] = $this->parseJsonArray($request->what_you_will_learn_ar);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        TherapyProgram::create($validated);

        return redirect()->route('admin.programs.index')->with('success', __('messages.program_created'));
    }

    public function edit(TherapyProgram $program)
    {
        $services = Service::active()->get();
        $providers = ProviderProfile::verified()->with('user')->get();
        return view('admin.programs.edit', compact('program', 'services', 'providers'));
    }

    public function update(Request $request, TherapyProgram $program)
    {
        $validated = $this->validateProgram($request, $program->id);

        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['what_you_will_learn_en'] = $this->parseJsonArray($request->what_you_will_learn_en);
        $validated['what_you_will_learn_ar'] = $this->parseJsonArray($request->what_you_will_learn_ar);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', __('messages.program_updated'));
    }

    public function destroy(TherapyProgram $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', __('messages.program_deleted'));
    }

    private function validateProgram(Request $request, $id = null)
    {
        $rules = [
            'service_id' => 'nullable|exists:services,id',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:therapy_programs' . ($id ? ",slug,{$id}" : ''),
            'description_en' => 'required|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'program_type' => 'required|in:group,individual,workshop',
            'duration' => 'nullable|string|max:255',
            'session_count' => 'nullable|integer',
            'price_per_session' => 'nullable|numeric',
            'full_program_price' => 'nullable|numeric',
            'currency' => 'nullable|in:SAR,USD',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'max_participants' => 'nullable|integer',
            'what_you_will_learn_en' => 'nullable',
            'what_you_will_learn_ar' => 'nullable',
            'program_schedule_en' => 'nullable|string',
            'program_schedule_ar' => 'nullable|string',
            'facilitator_provider_id' => 'nullable|exists:provider_profiles,id',
            'level' => 'nullable|in:beginner,intermediate,advanced',
        ];

        return $request->validate($rules);
    }

    private function parseJsonArray($value)
    {
        if (is_string($value)) {
            $lines = array_filter(array_map('trim', explode("\n", $value)));
            return json_encode(array_values($lines));
        }
        return json_encode($value ?: []);
    }
}
