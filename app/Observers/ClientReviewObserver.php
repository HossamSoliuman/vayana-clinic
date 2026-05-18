<?php

namespace App\Observers;

use App\Models\ClientReview;
use App\Models\ProviderProfile;

class ClientReviewObserver
{
    public function saved(ClientReview $review)
    {
        if ($review->is_approved && $review->related_provider_id) {
            $this->recalculateProviderRating($review->related_provider_id);
        }
    }

    public function updated(ClientReview $review)
    {
        if ($review->isDirty('is_approved')) {
            if ($review->related_provider_id) {
                $this->recalculateProviderRating($review->related_provider_id);
            }
            if ($review->getOriginal('related_provider_id') && $review->getOriginal('related_provider_id') !== $review->related_provider_id) {
                $this->recalculateProviderRating($review->getOriginal('related_provider_id'));
            }
        }
    }

    public function deleted(ClientReview $review)
    {
        if ($review->related_provider_id) {
            $this->recalculateProviderRating($review->related_provider_id);
        }
    }

    private function recalculateProviderRating($providerId)
    {
        $provider = ProviderProfile::find($providerId);
        if (!$provider) return;

        $reviews = ClientReview::where('related_provider_id', $providerId)
            ->where('is_approved', true)
            ->get();

        $provider->update([
            'rating_average' => $reviews->avg('rating') ?: 0.00,
            'rating_count' => $reviews->count(),
        ]);
    }
}
