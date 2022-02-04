<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index',[
            'categories' => Category::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'category_name' => 'required',
            'category_price' => 'required',
            'category_image' => 'required | image',
        ]);
        $category_image = time().Str::random(5).'.'.$request->file('category_image')->getClientOriginalExtension();
        Image::make($request->file('category_image'))->save(base_path('public/image/category/'.$category_image));

        Category::insert([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'price' => $request->category_price,
            'image' => $category_image,
            'created_at' => Carbon::now()
        ]);
        return back()->with('success', 'Category added successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        return view('backend.category.edit',[
            'data' => Category::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'category_name' => 'required',
            'category_price' => 'required',
            'category_image' => 'image',
        ]);
        if($request->hasFile('category_image'))
        {
            $oldImg = Category::where('id', $id)->first()->image;
            unlink(base_path('public/image/category/'.$oldImg));
            $category_image = time().Str::random(5).'.'.$request->file('category_image')->getClientOriginalExtension();
            Image::make($request->file('category_image'))->save(base_path('public/image/category/'.$category_image));
            Category::where('id', $id)->update([
                'image' => $category_image
            ]);
        }
        Category::where('id', $id)->update([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'price' => $request->category_price,
            'status' => $request->status,
        ]);
        return redirect('category')->with('success', 'Category Update successfull');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $oldImg = Category::where('id', $id)->first()->image;
        unlink(base_path('public/image/category/'.$oldImg));
        Category::where('id', $id)->delete();
        return back()->with('success', 'Category Delete successfull');
    }
}
