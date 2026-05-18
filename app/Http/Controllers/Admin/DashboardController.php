<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\BusinessInquiry;
use App\Models\ClientReview;
use App\Models\ProviderApplication;
use App\Models\ProviderProfile;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_clients' => User::byRole('client')->count(),
            'total_providers' => ProviderProfile::count(),
            'verified_providers' => ProviderProfile::verified()->count(),
            'pending_applications' => ProviderApplication::pending()->count(),
            'pending_appointments' => AppointmentRequest::pending()->count(),
            'new_inquiries' => BusinessInquiry::new()->count(),
            'pending_reviews' => ClientReview::where('is_approved', false)->count(),
        ];

        $recentApplications = ProviderApplication::pending()->orderBy('created_at', 'desc')->take(5)->get();
        $recentAppointments = AppointmentRequest::pending()->orderBy('created_at', 'desc')->take(5)->get();
        $recentInquiries = BusinessInquiry::new()->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentApplications', 'recentAppointments', 'recentInquiries'));
    }
}
