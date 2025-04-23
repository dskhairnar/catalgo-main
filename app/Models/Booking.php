<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'booking_time',
        'status',
        'notes'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'booking_time' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }
}
