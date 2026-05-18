<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = ProviderApplication::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.applications.index', compact('applications'));
    }

    public function show(ProviderApplication $application)
    {
        $application->load('reviewer');
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, ProviderApplication $application)
    {
        $request->validate([
            'status' => 'required|in:submitted,under_review,interview_scheduled,approved,rejected',
            'review_notes' => 'nullable|string',
            'rejection_reason' => 'nullable|string|required_if:status,rejected',
        ]);

        $application->update([
            'status' => $request->status,
            'review_notes' => $request->review_notes,
            'rejection_reason' => $request->rejection_reason,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', __('messages.application_status_updated'));
    }

    public function scheduleInterview(Request $request, ProviderApplication $application)
    {
        $request->validate([
            'interview_date' => 'required|date|after:now',
        ]);

        $application->update([
            'status' => 'interview_scheduled',
            'interview_date' => $request->interview_date,
            'reviewed_by' => auth()->id(),
        ]);

        return back()->with('success', __('messages.interview_scheduled'));
    }
}
