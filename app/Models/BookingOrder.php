<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'pickupDate',
        'pickupTime',
        'dropoffDate',
        'dropoffTime',
        'duration',
        'amount',
        'payment_status',
        'status',
        'entertainmentMenu',
        'event',
        'address',
        'participants',
        'hours',
        'no_of_stops',
        'selectedMenus',
        'entertainment_date',
        'entertainment'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
