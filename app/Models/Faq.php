<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_en',
        'question_ar',
        'answer_en',
        'answer_ar',
        'category',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getLocalizedQuestionAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' && $this->question_ar ? $this->question_ar : $this->question_en;
    }

    public function getLocalizedAnswerAttribute()
    {
        $locale = app()->getLocale();
        return $locale === 'ar' && $this->answer_ar ? $this->answer_ar : $this->answer_en;
    }
}
