<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'price',
        'currency',
        'billing_cycle',
        'features_en',
        'features_ar',
        'session_credits',
        'is_active',
    ];

    protected $casts = [
        'features_en' => 'array',
        'features_ar' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function clientProfiles()
    {
        return $this->hasMany(ClientProfile::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
