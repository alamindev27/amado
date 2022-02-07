<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fname',
        'email',
        'country_id',
        'address',
        'town',
        'zipcode',
        'phone',
        'message',
        'subtotal',
        'total',
        'payment',
    ];
}
