<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function getAllProduct(){
        $products = Product::select()
                    ->get();

        return view('Products.product', compact('products'));
    }
}
