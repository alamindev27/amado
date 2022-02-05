<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductThumbnails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index',[
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create',[
            'categories' => Category::where('status', 1)->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brands' => 'required',
            'price' => 'numeric | min:1',
            'description' => 'required',
            'stock' => 'numeric | min:1',
            'image' => 'required | image',
            'thumbnails' => 'required',
            // 'thumbnails' => 'image'
        ],[
            'category_id.required' => 'The category field is required',
        ]);
        $productImage = time().Str::random(10).'.'.$request->file('image')->getClientOriginalExtension();
        Image::make($request->file('image'))->resize(723, 747)->save(base_path('public/image/product/'.$productImage));
        $productId = Product::insertGetId([
            'user_id' => auth()->id(),
            'category_id' => Crypt::decrypt($request->category_id),
            'slug' => Str::slug($request->name).'-'.Str::random(5),
            'name' => $request->name,
            'brands' => $request->brands,
            'price' => $request->price,
            'image' => $productImage,
            'description' => $request->description,
            'stock' => $request->stock,
            'created_at' => Carbon::now()
        ]);
        foreach($request->thumbnails as $thumbnail)
        {
            $thumb = time().Str::random(10).'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(723, 747)->save(base_path('public/image/thumbnails/'.$thumb));

            ProductThumbnails::insert([
                'product_id' => $productId,
                'thumbnails' => $thumb,
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('success', 'Product added successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        return view('backend.product.show',[
            'product' => Product::where('id', $id)->first(),
            'thumbnails' => ProductThumbnails::where('product_id', $id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        return view('backend.product.edit',[
            'product' => Product::where('id', $id)->first(),
            'thumbnails' => ProductThumbnails::where('product_id', $id)->get(),
            'categories' => Category::where('status', 1)->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'name' => 'required',
            'brands' => 'required',
            'price' => 'numeric | min:1',
            'description' => 'required',
            'stock' => 'numeric | min:1',
            'image' => 'image',
        ],[
            'category_id.required' => 'The category field is required',
        ]);
        if($request->hasFile('image'))
        {
            $oldImage = Product::where('id', $id)->first()->image;
            unlink(base_path('public/image/product/'.$oldImage));

            $productImage = time().Str::random(10).'.'.$request->file('image')->getClientOriginalExtension();
            Image::make($request->file('image'))->resize(723, 747)->save(base_path('public/image/product/'.$productImage));
            Product::where('id', $id)->update([
                'image' => $productImage
            ]);
        }
        if($request->hasFile('thumbnails'))
        {
            foreach(ProductThumbnails::where('product_id', $id)->get() as $thumb)
            {
                unlink(base_path('public/image/thumbnails/'.$thumb->thumbnails));

                ProductThumbnails::find($thumb->id)->delete();
            }
            foreach($request->thumbnails as $thumbnail)
            {
                $thum = time().Str::random(10).'.'.$thumbnail->getClientOriginalExtension();
                Image::make($thumbnail)->resize(723, 747)->save(base_path('public/image/thumbnails/'.$thum));

                ProductThumbnails::insert([
                    'product_id' => $id,
                    'thumbnails' => $thum,
                    'created_at' => Carbon::now()
                ]);
            }
        }

        Product::where('id', $id)->update([
            'category_id' => Crypt::decrypt($request->category_id),
            'slug' => Str::slug($request->name).'-'.Str::random(5),
            'name' => $request->name,
            'brands' => $request->brands,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
        ]);
        return redirect('products')->with('success', 'Product update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);

        $oldImage = Product::where('id', $id)->first()->image;
        unlink(base_path('public/image/product/'.$oldImage));
        Product::where('id', $id)->delete();

        foreach(ProductThumbnails::where('product_id', $id)->get() as $thumb)
        {
            unlink(base_path('public/image/thumbnails/'.$thumb->thumbnails));
            ProductThumbnails::find($thumb->id)->delete();
        }
        return back()->with('success', 'Product delete successfull');

    }
}
