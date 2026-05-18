<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequestRequest;
use App\Models\AppointmentRequest;
use App\Models\ProviderProfile;
use Illuminate\Http\Request;

class InPersonController extends Controller
{
    public function index()
    {
        $providers = ProviderProfile::publicListing()->get();
        return view('in-person.index', compact('providers'));
    }

    public function store(AppointmentRequestRequest $request)
    {
        AppointmentRequest::create($request->validated());
        return back()->with('success', __('messages.appointment_submitted'));
    }
}
