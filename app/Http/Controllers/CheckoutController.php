<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderSummary;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            '*' => 'required'
        ]);

        if(Cart::where('user_id', auth()->id())->exists())
        {
            if(strpos(url()->previous(), 'cart'))
            {
                return view('frontend.checkout',[
                    'countries' => Country::where('status', 1)->get()
                ]);
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect('cart')->with('CartError', 'Your Cart is Empty');
        }
    }

    public function checkoutStore(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required | email',
            'countryid' => 'required',
            'address' => 'required',
            'town' => 'required',
            'postcode' => 'numeric',
            'number' => 'required | numeric',
            'payment' => 'required'
        ]);
        $orderSummartId = OrderSummary::insertGetId([
            'user_id' => auth()->id(),
            'grand_total' => Session::get('cartTotal'),
            'payment_option' => $request->payment,
            'created_at' => Carbon::now(),
        ]);

        OrderDetail::insert([
            'order_summary_id' => $orderSummartId,
            'fname' => $request->fname,
            'email' => $request->email,
            'country_id' => $request->countryid,
            'address' => $request->address,
            'town' => $request->town,
            'postcode' => $request->postcode,
            'phone' => $request->number,
            'message' => $request->message,
            'created_at' =>Carbon::now(),
        ]);

        foreach(Cart::where('user_id', auth()->id())->get() as $product)
        {
            OrderItem::insert([
                'order_summary_id' => $orderSummartId,
                'product_id' => $product->product_id,
                'quantity' => $product->quantity,
                'admin_id' => $product->admin_id,
                'created_at' => Carbon::now(),
            ]);

            Product::find($product->product_id)->decrement('stock', $product->quantity);
        }
        Cart::where('user_id', auth()->id())->delete();

        if($request->payment == 1)
        {

            return redirect('/')->with('success', 'Order Done');
        }
        else
        {
            return 'online';
        }

    }
}
