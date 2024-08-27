<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'driver_id',
        'user_id',
        'vehicle_id',
        'originCoords',
        'destinationCoords',
        'amount',
        'status'
    ];

}
