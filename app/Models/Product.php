<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'category_id',
        'slug',
        'name',
        'brand_id',
        'price',
        'image',
        'description',
        'stock',
    ];
    public function relationwithcategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function relationwithuser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function relationwithbrand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
