<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'admin_id',
        'product_id',
        'quantity',
    ];
    public function relationwithproduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
