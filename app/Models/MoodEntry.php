<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mood_score',
        'mood_label',
        'notes',
        'entry_date',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'mood_score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('entry_date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('entry_date', now()->month)->whereYear('entry_date', now()->year);
    }
}
