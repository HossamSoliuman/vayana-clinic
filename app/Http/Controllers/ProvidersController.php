<?php

namespace App\Http\Controllers;

use App\Models\ProviderProfile;
use App\Models\Specialty;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['specialty', 'language', 'work_type', 'gender', 'search', 'sort']);
        $providers = ProviderProfile::publicListing()
            ->withFilters($filters)
            ->with(['user', 'specialties', 'languages'])
            ->paginate(12);

        $specialties = Specialty::active()->orderBy('name_en')->get();

        return view('providers.index', compact('providers', 'specialties', 'filters'));
    }

    public function show($id)
    {
        $provider = ProviderProfile::publicListing()
            ->with(['user', 'specialties', 'languages', 'availabilities', 'reviews' => function ($q) {
                $q->approved();
            }])
            ->findOrFail($id);

        return view('providers.show', compact('provider'));
    }
}
