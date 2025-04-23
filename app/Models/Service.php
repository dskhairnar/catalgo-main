<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'business_id',
        'category_id',
    ];

    /**
     * Get the bookings for the service.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the business that owns the service.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Get the category that the service belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}