<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::orderBy('price')->paginate(20);
        return view('admin.subscription-plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subscription_plans',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|in:SAR,USD',
            'billing_cycle' => 'required|in:monthly,yearly',
            'features_en' => 'nullable|string',
            'features_ar' => 'nullable|string',
            'session_credits' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['features_en'] = $this->parseFeatures($request->features_en);
        $validated['features_ar'] = $this->parseFeatures($request->features_ar);

        SubscriptionPlan::create($validated);

        return redirect()->route('admin.subscription-plans.index')->with('success', __('messages.plan_created'));
    }

    public function update(Request $request, SubscriptionPlan $plan)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subscription_plans,slug,' . $plan->id,
            'price' => 'required|numeric|min:0',
            'currency' => 'required|in:SAR,USD',
            'billing_cycle' => 'required|in:monthly,yearly',
            'features_en' => 'nullable|string',
            'features_ar' => 'nullable|string',
            'session_credits' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['features_en'] = $this->parseFeatures($request->features_en);
        $validated['features_ar'] = $this->parseFeatures($request->features_ar);

        $plan->update($validated);

        return redirect()->route('admin.subscription-plans.index')->with('success', __('messages.plan_updated'));
    }

    private function parseFeatures($value)
    {
        if (is_string($value) && !empty($value)) {
            $lines = array_filter(array_map('trim', explode("\n", $value)));
            return json_encode(array_values($lines));
        }
        return json_encode([]);
    }
}
