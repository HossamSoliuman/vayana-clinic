<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_path',
        'title',
        'biography_en',
        'biography_ar',
        'license_number',
        'license_document_path',
        'cv_path',
        'certificates_path',
        'years_of_experience',
        'session_price_online',
        'session_price_inperson',
        'currency',
        'work_type',
        'availability_schedule',
        'next_available_date',
        'is_verified',
        'is_featured',
        'is_available',
        'rating_average',
        'rating_count',
        'application_status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'certificates_path' => 'array',
        'availability_schedule' => 'array',
        'session_price_online' => 'decimal:2',
        'session_price_inperson' => 'decimal:2',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_available' => 'boolean',
        'rating_average' => 'decimal:2',
        'next_available_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'provider_specialty');
    }

    public function languages()
    {
        return $this->hasMany(ProviderLanguage::class);
    }

    public function availabilities()
    {
        return $this->hasMany(ProviderAvailability::class);
    }

    public function reviews()
    {
        return $this->hasMany(ClientReview::class, 'related_provider_id');
    }

    public function therapyPrograms()
    {
        return $this->hasMany(TherapyProgram::class, 'facilitator_provider_id');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePublicListing($query)
    {
        return $query->where('is_verified', true)->where('is_available', true);
    }

    public function scopeWithFilters($query, array $filters)
    {
        if (!empty($filters['specialty'])) {
            $query->whereHas('specialties', function ($q) use ($filters) {
                $q->where('slug', $filters['specialty']);
            });
        }

        if (!empty($filters['language'])) {
            $query->whereHas('languages', function ($q) use ($filters) {
                $q->where('language', $filters['language']);
            });
        }

        if (!empty($filters['work_type'])) {
            $query->where('work_type', $filters['work_type']);
        }

        if (!empty($filters['gender'])) {
            $query->whereHas('user', function ($q) use ($filters) {
                $q->whereHas('clientProfile', function ($sq) use ($filters) {
                    $sq->where('gender', $filters['gender']);
                });
            });
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('biography_en', 'like', "%{$search}%")
                  ->orWhere('biography_ar', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($sq) use ($search) {
                      $sq->where('first_name_en', 'like', "%{$search}%")
                         ->orWhere('last_name_en', 'like', "%{$search}%")
                         ->orWhere('first_name_ar', 'like', "%{$search}%")
                         ->orWhere('last_name_ar', 'like', "%{$search}%");
                  })
                  ->orWhereHas('specialties', function ($sq) use ($search) {
                      $sq->where('name_en', 'like', "%{$search}%")
                         ->orWhere('name_ar', 'like', "%{$search}%");
                  });
            });
        }

        if (!empty($filters['sort'])) {
            match ($filters['sort']) {
                'rating' => $query->orderBy('rating_average', 'desc'),
                'price_asc' => $query->orderBy('session_price_online', 'asc'),
                'price_desc' => $query->orderBy('session_price_online', 'desc'),
                'experience' => $query->orderBy('years_of_experience', 'desc'),
                'availability' => $query->orderBy('next_available_date', 'asc'),
                default => $query->orderBy('is_featured', 'desc')->orderBy('rating_average', 'desc'),
            };
        } else {
            $query->orderBy('is_featured', 'desc')->orderBy('rating_average', 'desc');
        }

        return $query;
    }
}
