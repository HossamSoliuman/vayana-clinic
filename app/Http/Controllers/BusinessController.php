<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessInquiryRequest;
use App\Models\BusinessInquiry;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        return view('business.index');
    }

    public function store(BusinessInquiryRequest $request)
    {
        BusinessInquiry::create($request->validated());
        return back()->with('success', __('messages.business_inquiry_submitted'));
    }
}
