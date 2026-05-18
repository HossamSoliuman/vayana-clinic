<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessInquiryRequest;
use App\Models\BusinessInquiry;

class BusinessInquiryController extends Controller
{
    public function store(BusinessInquiryRequest $request)
    {
        BusinessInquiry::create($request->validated());
        return back()->with('success', __('messages.business_inquiry_submitted'));
    }
}
