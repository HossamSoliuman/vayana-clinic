<?php

namespace App\Observers;

use App\Models\ProviderApplication;
use App\Models\User;
use App\Models\ProviderProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProviderApplicationObserver
{
    public function updated(ProviderApplication $application)
    {
        if ($application->isDirty('status') && $application->status === 'approved') {
            $this->processApproval($application);
        }
    }

    private function processApproval(ProviderApplication $application)
    {
        $existingUser = User::where('email', $application->email)->first();

        if ($existingUser) {
            return;
        }

        $password = Str::random(12);

        $user = User::create([
            'role' => 'provider',
            'email' => $application->email,
            'password' => Hash::make($password),
            'phone' => $application->phone,
            'first_name_en' => $application->full_name,
            'last_name_en' => '',
            'locale' => 'ar',
            'is_active' => true,
        ]);

        ProviderProfile::create([
            'user_id' => $user->id,
            'license_number' => $application->license_number,
            'biography_en' => $application->biography,
            'work_type' => $application->preferred_work_type,
            'license_document_path' => $application->license_document_path,
            'cv_path' => $application->cv_path,
            'application_status' => 'approved',
            'is_verified' => false,
        ]);

        $application->update([
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // TODO: Send welcome email with password setup link
    }
}
