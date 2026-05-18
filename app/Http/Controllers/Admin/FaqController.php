<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('display_order')->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'nullable|string|max:255',
            'answer_en' => 'required|string',
            'answer_ar' => 'nullable|string',
            'category' => 'required|in:general,services,appointments,billing,business,providers',
            'display_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', __('messages.faq_created'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'nullable|string|max:255',
            'answer_en' => 'required|string',
            'answer_ar' => 'nullable|string',
            'category' => 'required|in:general,services,appointments,billing,business,providers',
            'display_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', __('messages.faq_updated'));
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', __('messages.faq_deleted'));
    }
}
