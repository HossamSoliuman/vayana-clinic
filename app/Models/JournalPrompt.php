<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalPrompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'prompt_text_en',
        'prompt_text_ar',
        'category',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function entries()
    {
        return $this->hasMany(JournalEntry::class, 'prompt_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getLocalizedTextAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' && $this->prompt_text_ar ? $this->prompt_text_ar : $this->prompt_text_en;
    }
}
