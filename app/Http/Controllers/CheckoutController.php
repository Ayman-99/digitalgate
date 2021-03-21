<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        if(Cart::instance('shopping')->count() > 0){
            return view('checkout');
        } else {
            return back();
        }
    }

    public function addDiscount(Request $request){
        if(Auth::user()->balance >= Cart::instance('shopping')->subtotal()){
            session()->put('discount', Cart::instance('shopping')->subtotal());
            return response(array(
                'success' => true,
                'dis' => Cart::instance('shopping')->subtotal(),
                'total' => 0
            ), 200, []);
        } else {
            session()->put('discount', $request->discount);
            return response(array(
                'success' => true,
                'dis' => $request->discount,
                'total' => Cart::instance('shopping')->subtotal() - $request->discount
            ), 200, []);
        }
    }
}
