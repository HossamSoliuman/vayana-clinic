<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(ClientRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'role' => 'client',
            'first_name_en' => $validated['first_name_en'],
            'last_name_en' => $validated['last_name_en'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'locale' => $validated['locale'] ?? 'ar',
        ]);

        $user->clientProfile()->create([
            'subscription_plan_id' => null,
            'subscription_expires_at' => null,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', __('messages.registration_success'));
    }
}
