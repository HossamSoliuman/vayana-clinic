<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderApplicationRequest;
use App\Models\ProviderApplication;
use Illuminate\Support\Facades\Storage;

class ProviderApplicationController extends Controller
{
    public function store(ProviderApplicationRequest $request)
    {
        $data = $request->safe()->except(['license_document', 'cv_document', 'certificates']);

        $appId = 'APP-' . time();

        if ($request->hasFile('license_document')) {
            $data['license_document_path'] = $request->file('license_document')
                ->storeAs("providers/{$appId}", 'license.pdf', 'private');
        }

        if ($request->hasFile('cv_document')) {
            $data['cv_path'] = $request->file('cv_document')
                ->storeAs("providers/{$appId}", 'cv.pdf', 'private');
        }

        if ($request->hasFile('certificates')) {
            $data['certificates_path'] = $request->file('certificates')
                ->storeAs("providers/{$appId}/certificates", 'certificates.pdf', 'private');
        }

        ProviderApplication::create($data);

        return back()->with('success', __('messages.application_submitted'));
    }
}
