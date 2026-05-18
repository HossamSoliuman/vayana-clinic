<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    public function index()
    {
        $workshops = Workshop::active()->orderBy('date_time', 'asc')->paginate(12);
        return view('workshops.index', compact('workshops'));
    }

    public function show(Workshop $workshop)
    {
        return view('workshops.show', compact('workshop'));
    }

    public function registerInterest(Request $request, Workshop $workshop)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
        ]);

        // Here you would store the registration interest
        // and possibly send a notification

        return back()->with('success', __('messages.workshop_register_success'));
    }
}
