<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductThumbnails;
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
            'title' => Category::where('slug', $slug)->first()->slug,
            'products' => Product::where('category_id', Category::where('slug', $slug)->first()->id)->latest()->paginate(12),
            'categories' => Category::where('status', 1)->latest()->limit(9)->get(),
            'brands' => Brand::latest()->limit(8)->get()
        ]);
    }

    public function productDetails($slug)
    {
        return view('frontend.productdetails',[
            'product' => Product::where('slug', $slug)->first(),
            'productThumbnails' => ProductThumbnails::where('product_id', Product::where('slug', $slug)->first()->id)->get()
        ]);
    }
}
