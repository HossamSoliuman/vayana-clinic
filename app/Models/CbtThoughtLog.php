<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtThoughtLog extends Model
{
    use HasFactory;

    protected $table = 'cbt_thought_logs';

    protected $fillable = [
        'user_id',
        'situation',
        'thought',
        'emotion',
        'emotion_intensity',
        'response',
        'alternative_thought',
        'log_date',
    ];

    protected $casts = [
        'log_date' => 'datetime',
        'emotion_intensity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
