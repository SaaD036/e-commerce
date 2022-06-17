<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\ConfirmOrder;
use App\Models\Product;
use App\Models\Carts;
use App\Models\Payment;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(){
        $sale = ConfirmOrder::where('is_completed', true)->sum('amount');
        $soldProductUnit = ConfirmOrder::join('carts', 'confirm_orders.id', 'carts.confirm_order_id')
                            ->where('is_completed', true)
                            ->sum('carts.amount');
        $countCustomerWhoOrdered = ConfirmOrder::select('id', 'user_id')->groupBy('user_id')
                                    ->where('is_completed', true)
                                    ->count();
        $users = User::with('completedOrder')->get();

        foreach($users as $user){
            $user->total_payment = ConfirmOrder::countTotalPayment($user->completedOrder);
        }

        return view('Admin.home', compact('sale', 'soldProductUnit', 'countCustomerWhoOrdered', 'users',));
    }

    public function createProduct(){
        $categories = Category::get();
        return view('Admin.insertProduct', compact('categories'));
    }

    public function storeProduct(Request $request){
        $product = new Product;

        $request->validate([
            'title' => 'required|max:250',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->offer_price = $request->offer;
        $product->quantity = $request->amount;
        $product->brand_id = 1;
        $product->category_id = $request->category_id;
        $product->status = 1;
        $product->admin_id = Auth::user()->id;
        $product->slug = '';

        $product->save();
        return redirect()->route('store-product');
    }

    public function editProduct(){
        $products = Product::select()->get();

        return view('Admin.editProduct', compact('products'));
    }

    public function editOneProduct(Request $request, $id){
        $products = Product::select()
                    ->where('id', '=', $id)
                    ->get();

        $product = $products[0];
        return view('Admin.editOneProduct', compact('product'));;
        // return $product;
    }
    
    public function updateOneProduct(Request $request, $id){
        if($request->title){
            Product::where('id', '=', $id)
                    ->update(['title' => $request->title]);
        }
        if($request->description){
            Product::where('id', '=', $id)
                    ->update(['description' => $request->description]);
        }
        if($request->price){
            Product::where('id', '=', $id)
                    ->update(['price' => $request->price]);
        }
        if($request->offer){
            Product::where('id', '=', $id)
                    ->update(['offer_price' => $request->offer]);
        }if($request->amount){
            Product::where('id', '=', $id)
                    ->update(['quantity' => $request->amount]);
        }
        if($request->brand_id){
            Product::where('id', '=', $id)
                    ->update(['brand_id' => $request->brand_id]);
        }
        if($request->category_id){
            Product::where('id', '=', $id)
                    ->update(['category_id' => $request->category_id]);
        }


        return redirect()->route('edit-product');
    }

    public function downloadExcel(){
        $products = Product::select()->get();

        $proData = '<table>
        <tr>
            <th>Product name</th>
            <th>Price</th>
            <th>Offer</th>
            <th>Amount</th>
            <th>Brand</th>
        </tr>';

        foreach($products as $product){
            $proData .= '
            <tr>
                <td>'.$product->title.'</td>
                <td>'.$product->price.'</td>
                <td>'.$product->offer_price.'</td>
                <td>'.$product->quantity.'</td>
                <td>'.$product->brand_id.'</td>
            </tr>';
        }

        header('Content-Type: application.xls');
        header('Content-Disposition: attachment; filename=product.xls');
        echo $proData;

        //return $products;
    }

    public function showOrder(){
        $completed_orders = ConfirmOrder::where('is_completed', true)
                        ->orWhere('is_shipped', true)
                        ->with('user', 'carts', 'carts.product', 'payment')
                        ->get();
        $current_order = ConfirmOrder::where('is_completed', false)
                        ->where('is_shipped', false)
                        ->where('is_paid', true)
                        ->with('user',  'carts', 'carts.product', 'payment')
                        ->get();
        $incompleted_order = ConfirmOrder::where('is_completed', false)
                        ->where('is_shipped', false)
                        ->where('is_paid', false)
                        ->with('user',  'carts', 'carts.product', 'payment')
                        ->get();
        
        return view('Admin.order.order', compact('completed_orders', 'incompleted_order', 'current_order'));
    }

    public function confirmPayment($id){
        ConfirmOrder::where('id', $id)
            ->where('is_paid', true)
            ->update([
                'is_completed' => true,
                'is_shipped' => false,
            ]);
        
        return back();
    }

    public function deletePayment($id){
        ConfirmOrder::where('id', $id)
            ->update([
                'is_completed' => false,
                'is_paid' => false,
                'is_shipped' => false,
            ]);

        Payment::where('confirm_order_id', $id)->delete();
        
        return back();
    }

    public function makeShipment($id){
        ConfirmOrder::where('id', $id)
            ->where('is_paid', true)
            ->where('is_completed', true)
            ->update([
                'is_shipped' => true,
            ]);
        
        return back();
    }
}
