<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Product;
use App\Models\District;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::select()->get();
        // $products->description = substr($products->description, 0, 100);

        return view('home_user', compact('products'));
    }

    public function signup(Request $request){
        $district = District::where('id', '=', $request->district_id)->first();
        $string = '';

        User::create([
            'first_name' => $request->f_name,
            'last_name' => $request->l_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => 'https://cdn.pixabay.com/photo/2018/08/28/12/41/avatar-3637425_960_720.png',
            'password' => Hash::make($request->password),
            'status' => 0,
            'street_address' => $request->street,
            'divison_id' => $district->division_id,
            'district_id' => $request['district_id'],
            'ip_address' => request()->ip(),
            'remember_token' => $string
        ]);

        return redirect()->route('home');
    }
}
