<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'preferred_provider_id',
        'preferred_date',
        'preferred_time',
        'reason_for_visit',
        'status',
        'admin_notes',
        'clinic_location_en',
        'clinic_location_ar',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime:H:i',
        'processed_at' => 'datetime',
    ];

    public function preferredProvider()
    {
        return $this->belongsTo(ProviderProfile::class, 'preferred_provider_id');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }
}
