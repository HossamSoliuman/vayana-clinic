<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('display_order')->get();
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        $service->load(['therapyPrograms' => function ($q) {
            $q->active();
        }]);
        return view('services.show', compact('service'));
    }
}
