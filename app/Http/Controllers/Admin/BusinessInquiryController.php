<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessInquiry;
use App\Models\User;
use Illuminate\Http\Request;

class BusinessInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = BusinessInquiry::with('assignedUser');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->orderBy('created_at', 'desc')->paginate(20);
        $staff = User::whereIn('role', ['admin', 'super_admin'])->get();
        return view('admin.business-inquiries.index', compact('inquiries', 'staff'));
    }

    public function show(BusinessInquiry $inquiry)
    {
        $inquiry->load('assignedUser');
        $staff = User::whereIn('role', ['admin', 'super_admin'])->get();
        return view('admin.business-inquiries.show', compact('inquiry', 'staff'));
    }

    public function update(Request $request, BusinessInquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,contacted,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'admin_notes' => 'nullable|string',
        ]);

        $inquiry->update([
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', __('messages.inquiry_updated'));
    }
}
