<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ar',
        'slug',
        'description_en',
        'description_ar',
        'short_description_en',
        'short_description_ar',
        'image',
        'instructor_name',
        'duration',
        'date_time',
        'location',
        'price',
        'currency',
        'max_participants',
        'registration_link',
        'is_registration_open',
        'category',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'price' => 'decimal:2',
        'is_registration_open' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOpen($query)
    {
        return $query->where('is_registration_open', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLocalizedTitleAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' && $this->title_ar ? $this->title_ar : $this->title_en;
    }

    public function getIsFreeAttribute()
    {
        return is_null($this->price);
    }
}
