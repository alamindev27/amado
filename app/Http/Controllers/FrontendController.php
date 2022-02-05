<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index',[
            'categories' => Category::where('status', 1)->latest()->get()
        ]);
    }

    public function shop($slug)
    {
        return view('frontend.shop',[
            'products' => Product::where('category_id', Category::where('slug', $slug)->first()->id)->latest()->limit(12)->get(),
            'categories' => Category::where('status', 1)->latest()->limit(9)->get(),
            'brands' => Brand::latest()->limit(8)->get()
        ]);
    }

    public function productDetails($slug)
    {
        # code...
    }
}
