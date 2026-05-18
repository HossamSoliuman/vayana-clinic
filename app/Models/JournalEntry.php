<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'prompt_id',
        'mood_score',
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

    public function prompt()
    {
        return $this->belongsTo(JournalPrompt::class, 'prompt_id');
    }

    public function getDecryptedContentAttribute()
    {
        try {
            return Crypt::decryptString($this->attributes['content']);
        } catch (\Exception $e) {
            return $this->attributes['content'];
        }
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = Crypt::encryptString($value);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['content'] = $this->getDecryptedContentAttribute();
        return $array;
    }
}
