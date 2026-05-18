<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'role',
        'email',
        'password',
        'phone',
        'first_name_en',
        'first_name_ar',
        'last_name_en',
        'last_name_ar',
        'avatar',
        'locale',
        'is_active',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function clientProfile()
    {
        return $this->hasOne(ClientProfile::class);
    }

    public function providerProfile()
    {
        return $this->hasOne(ProviderProfile::class);
    }

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function moodEntries()
    {
        return $this->hasMany(MoodEntry::class);
    }

    public function cbtThoughtLogs()
    {
        return $this->hasMany(CbtThoughtLog::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getFullNameAttribute()
    {
        $locale = app()->getLocale();
        $firstName = $locale === 'ar' ? ($this->first_name_ar ?? $this->first_name_en) : $this->first_name_en;
        $lastName = $locale === 'ar' ? ($this->last_name_ar ?? $this->last_name_en) : $this->last_name_en;
        return trim($firstName . ' ' . $lastName);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
