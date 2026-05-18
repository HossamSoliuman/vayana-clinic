<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'initials',
        'rating',
        'review_text_en',
        'review_text_ar',
        'is_approved',
        'is_featured',
        'display_order',
        'related_service_id',
        'related_provider_id',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'related_service_id');
    }

    public function provider()
    {
        return $this->belongsTo(ProviderProfile::class, 'related_provider_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
