<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function providers()
    {
        return $this->belongsToMany(ProviderProfile::class, 'provider_specialty');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
