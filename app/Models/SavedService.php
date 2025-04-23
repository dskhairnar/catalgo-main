<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedService extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
    ];

    /**
     * Get the user that saved the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service that was saved.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}