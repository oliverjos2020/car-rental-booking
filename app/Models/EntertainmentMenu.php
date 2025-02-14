<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntertainmentMenu extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'amount',
        'required',
        'charge_per_hour'
    ];
}
