<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = ClientReview::with('provider.user', 'service');

        if ($request->filled('status')) {
            $query->where('is_approved', $request->status === 'approved');
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(ClientReview $review)
    {
        $review->update(['is_approved' => !$review->is_approved]);
        return back()->with('success', __('messages.review_status_updated'));
    }

    public function toggleFeatured(ClientReview $review)
    {
        $review->update(['is_featured' => !$review->is_featured]);
        return back()->with('success', __('messages.review_featured_updated'));
    }

    public function destroy(ClientReview $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', __('messages.review_deleted'));
    }
}
