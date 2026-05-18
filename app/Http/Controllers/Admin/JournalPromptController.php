<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JournalPrompt;
use Illuminate\Http\Request;

class JournalPromptController extends Controller
{
    public function index()
    {
        $prompts = JournalPrompt::orderBy('category')->orderBy('display_order')->paginate(20);
        return view('admin.journal-prompts.index', compact('prompts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prompt_text_en' => 'required|string',
            'prompt_text_ar' => 'nullable|string',
            'category' => 'required|in:gratitude,reflection,emotion,goal_setting,mindfulness',
            'display_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        JournalPrompt::create($validated);

        return redirect()->route('admin.journal-prompts.index')->with('success', __('messages.prompt_created'));
    }

    public function update(Request $request, JournalPrompt $prompt)
    {
        $validated = $request->validate([
            'prompt_text_en' => 'required|string',
            'prompt_text_ar' => 'nullable|string',
            'category' => 'required|in:gratitude,reflection,emotion,goal_setting,mindfulness',
            'display_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);

        $prompt->update($validated);

        return redirect()->route('admin.journal-prompts.index')->with('success', __('messages.prompt_updated'));
    }

    public function destroy(JournalPrompt $prompt)
    {
        $prompt->delete();
        return redirect()->route('admin.journal-prompts.index')->with('success', __('messages.prompt_deleted'));
    }
}
