<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'contact_person_name',
        'email',
        'phone',
        'type_of_service',
        'organization_size',
        'message',
        'status',
        'assigned_to',
        'admin_notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }
}
