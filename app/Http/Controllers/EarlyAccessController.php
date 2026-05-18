<?php

namespace App\Http\Controllers;

use App\Models\EarlyAccessSignup;
use Illuminate\Http\Request;

class EarlyAccessController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:early_access_signups,email',
            'source' => 'nullable|string|max:255',
        ]);

        EarlyAccessSignup::create($request->only('email', 'source'));

        return back()->with('success', __('messages.early_access_success'));
    }
}
