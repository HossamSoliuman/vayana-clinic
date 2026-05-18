<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequestRequest;
use App\Models\AppointmentRequest;

class AppointmentController extends Controller
{
    public function store(AppointmentRequestRequest $request)
    {
        AppointmentRequest::create($request->validated());
        return back()->with('success', __('messages.appointment_submitted'));
    }
}
