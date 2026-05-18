<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::active()->orderBy('display_order')->get()->groupBy('category');
        return view('faqs.index', compact('faqs'));
    }
}
