<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name_en',
        'name_ar',
        'slug',
        'description_en',
        'description_ar',
        'image',
        'program_type',
        'duration',
        'session_count',
        'price_per_session',
        'full_program_price',
        'currency',
        'start_date',
        'end_date',
        'max_participants',
        'what_you_will_learn_en',
        'what_you_will_learn_ar',
        'program_schedule_en',
        'program_schedule_ar',
        'facilitator_provider_id',
        'level',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'what_you_will_learn_en' => 'array',
        'what_you_will_learn_ar' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'price_per_session' => 'decimal:2',
        'full_program_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function facilitator()
    {
        return $this->belongsTo(ProviderProfile::class, 'facilitator_provider_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLocalizedNameAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' && $this->name_ar ? $this->name_ar : $this->name_en;
    }
}
