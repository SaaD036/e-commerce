<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Carts;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function addProductToCart(Request $request, $id){
        $cart = Carts::where('user_id', Auth::user()->id)
                        ->where('product_id', $id)->first();

        if($cart){
            $cart->amount = $cart->amount+1;
            $cart->save();

            return back();
        }

        $cart = new Carts;
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $id;

        $cart->save();

        return back();
    }
}
