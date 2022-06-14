<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Carts;
use App\Models\ConfirmOrder;
use App\Models\Payment;

class OrderController extends Controller
{
    public function addProductToCart(Request $request, $product_id){
        $cart = Carts::where('user_id', Auth::user()->id)
                        ->where('product_id', $product_id)
                        ->where('is_ordered', false)
                        ->first();

        if($cart){
            $cart->amount = $cart->amount+1;
            $cart->save();

            return back();
        }

        $cart = new Carts;
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $product_id;

        $cart->save();

        return back();
    }

    public function showCart(){
        $cartItems = Carts::where('user_id', Auth::user()->id)
                    ->where('is_ordered', false)
                    ->get();
        return view('cart', compact('cartItems'));
    }

    public function confirmAllOrder(){
        $order = new ConfirmOrder;
        $order->user_id = Auth::user()->id;
        $order->address = Auth::user()->street_address;
        $order->message = 'gdh';
        $order->save();


        Carts::where('user_id', Auth::user()->id)
                ->where('is_ordered', false)
                ->update([
                    'is_ordered' => true,
                    'confirm_order_id' => $order->id,
                ]);
        
        return back();
    }

    public function addOneToCart($id){
        $cart = Carts::where('id', $id)
                ->where('is_ordered', false)
                ->first();
        
        if($cart){
            $cart->amount = $cart->amount+1;
            $cart->save();
        }

        return back();
    }

    public function removeOneFromCart($id){
        $cart = Carts::where('id', $id)
                ->where('is_ordered', false)
                ->first();
        
        if($cart){
            if($cart->amount <= 1) $cart->delete();
            else{
                $cart->amount = $cart->amount-1;
                $cart->save();
            }
        }

        return back();
    }

    public function showOrder(){
        $orders = ConfirmOrder::where('user_id', Auth::user()->id)->get();

        foreach($orders as $order){
            $order->user_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $order->item_count = Carts::where('confirm_order_id', $order->id)->count();
        }

        return view('order', compact('orders'));
    }

    public function deleteOrder($id){
        $order = ConfirmOrder::where('id', $id)
                    ->where('user_id', Auth::user()->id)
                    ->where('is_paid', false)
                    ->first();
        
        if($order){
            $order->delete();
            Carts::where('confirm_order_id', $order->id)->delete();
        }

        return back();
    }

    public function showSingleOrder($id){
        $order = ConfirmOrder::where('id', $id)->first();
        $carts = Carts::with('product', 'product.category')->where('confirm_order_id', $order->id)->get();

        $total_price = 0;
        $total_item = 0;
        $message = 'Your order is awaiting payment';

        foreach($carts as $cart){
            if($cart->product && $cart->product->price){
                $total_price = $total_price + ($cart->product->price - $cart->product->offer_price) * $cart->amount;
                $total_item = $total_item + $cart->amount;
            }
        }

        if($order->is_paid) $message='Your payment is received. We are reviewing this.';
        if($order->is_completed) $message='Your payment is completed. We are packaging your product.';
        if($order->is_shipped) $message='Your product is shipped.';

        return view('order-one', compact('order', 'carts', 'total_price', 'total_item', 'message')); 
    }

    public function makePayment(Request $request, $id){
        $payment = Payment::where('confirm_order_id', $id)->first();

        if($payment){
            $payment->transaction_id = $request->transaction_id;
            $payment->method = $request->method;
            $payment->save();
        }
        else{
            $payment = new Payment;
            $payment->transaction_id = $request->transaction_id;
            $payment->method = $request->method;
            $payment->confirm_order_id = $id;
            $payment->save();
        }

        ConfirmOrder::where('id', $id)
                        ->update([
                            'is_paid' => true,
                            'is_shipped' => false,
                            'is_completed' => false,
                            'is_seen' => false,
                        ]);

        return redirect('order/'.$id);
    }
}
