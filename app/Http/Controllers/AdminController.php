<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\ConfirmOrder;
use App\Models\Product;
use App\Models\Carts;


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
        return view('Admin.home');
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
        $product->status = $request->status;
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
                        ->with('user')
                        ->get();
        $current_order = ConfirmOrder::where('is_completed', false)
                        ->where('is_shipped', false)
                        ->where('is_paid', true)
                        ->with('user')
                        ->get();
        $incompleted_order = ConfirmOrder::where('is_completed', false)
                        ->where('is_shipped', false)
                        ->where('is_paid', false)
                        ->with('user')
                        ->get();
        
        $completed_orders = ConfirmOrder::addCartToOrderObject($completed_orders);
        $current_order = ConfirmOrder::addCartToOrderObject($current_order);
        $incompleted_order = ConfirmOrder::addCartToOrderObject($incompleted_order);
        
        // return $completed_orders;
        return view('Admin.order.order', compact('completed_orders', 'incompleted_order', 'current_order'));
    }
}
