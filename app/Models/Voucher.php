<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'voucher_name',
        'voucher_code',
        'discount_amount',
        'discount_type',
        'valid_from',
        'valid_until'
    ];

    // protected $casts = [
    //     'valid_until' => 'datetime',
    // ];
}
