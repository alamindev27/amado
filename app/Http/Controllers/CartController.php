<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    public function cart()
    {
        return view('frontend.cart',[
            'carts' => Cart::where('user_id', auth()->id())->latest()->get()
        ]);
    }
    public function index(Request $request)
    {
        $request->validate([
            'quentity' => 'required',
        ]);


        if(Product::where('id', $request->productId)->first()->stock < $request->quentity)
        {
            return response()->json('stockError');
        }
        else
        {
            if(Cart::where('product_id', $request->productId)->where('user_id', auth()->id())->exists())
            {
                Cart::where('product_id', $request->productId)->where('user_id', auth()->id())->increment('quantity', $request->quentity);
            }
            else
            {
                Cart::insert([
                    'user_id' => auth()->id(),
                    'admin_id' => Product::where('id', $request->productId)->first()->user_id,
                    'product_id' => $request->productId,
                    'quantity' => $request->quentity,
                    'created_at' => Carbon::now()
                ]);
            }
        }
        return response()->json('success');
    }



    public function cartUpdate(Request $request)
    {
        foreach($request->quantity as $producttId => $quantity)
        {
            Cart::where('product_id', $producttId)->where('user_id', auth()->id())->update([
                'quantity' => $quantity
            ]);
            return back()->with('success', 'Cart update successfull');
        }
    }






    public function removeCart($slug)
    {
        Cart::where('product_id', Product::where('slug', $slug)->first()->id)->delete();
        return back()->with('success', 'Remove Successfull');
    }
}

