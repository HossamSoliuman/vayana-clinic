<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = AppointmentRequest::with('preferredProvider');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(AppointmentRequest $appointment)
    {
        $appointment->load('preferredProvider.user', 'processor');
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, AppointmentRequest $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'admin_notes' => 'nullable|string',
            'clinic_location_en' => 'nullable|string',
            'clinic_location_ar' => 'nullable|string',
        ]);

        $appointment->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'clinic_location_en' => $request->clinic_location_en,
            'clinic_location_ar' => $request->clinic_location_ar,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        return back()->with('success', __('messages.appointment_status_updated'));
    }
}
