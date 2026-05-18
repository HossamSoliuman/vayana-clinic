<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLanguage extends Model
{
    use HasFactory;

    protected $table = 'provider_languages';

    protected $fillable = [
        'provider_profile_id',
        'language',
    ];

    public $timestamps = false;

    public function providerProfile()
    {
        return $this->belongsTo(ProviderProfile::class);
    }
}
