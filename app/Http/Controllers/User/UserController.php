<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\District;

class UserController extends Controller
{
    //
    public function show(Request $request, $id){
        if(Auth::check()==1 || Auth::check()=='1'){
            if((int) $id == Auth::user()->id){
                $user = User::where('id', $id)->first();
                $districts = District::select()->get();

                // return Auth::user();
                return view('User.home', compact('user', 'districts'));
            }
            else{
                // return 'user id unmatched';
                session()->flash('errors', 'You are not valid user');
                return redirect()->route('home-main');
            }
        }
        // return 'not logged in';
        else{
            session()->flash('errors', 'You are not logged in');
            return redirect()->route('home');
        }
    }

    public function update(Request $request, $id){
        if(Auth::check()==1 || Auth::check()=='1'){
            if((int) $id == Auth::user()->id){
                $user = User::where('id', $id)->first();

                if($request->email){
                    $user->email = $request->email;
                }
                if($request->f_name){
                    $user->first_name = $request->f_name;
                }
                if($request->l_name){
                    $user->last_name = $request->l_name;
                }
                if($request->phone){
                    $user->phone = $request->phone;
                }
                if($request->street){
                    $user->street_address = $request->street;
                }

                $user->save();
                session()->flash('success', 'User updated successfully');
                return redirect('/user/'.$id);
            }
            else{
                // return 'user id unmatched';
                session()->flash('errors', 'You are not valid user');
                return redirect()->route('home-main');
            }
        }
        else{
            session()->flash('errors', 'You are not logged in');
            return redirect()->route('home');
        }
    }

    public function verifyUser(Request $request, $token_number){
        $user = User::where('remember_token', $token_number)->first();

        if(empty($user)){
            session()->flash('error', 'Your token is invalid');
        }

        $user->status = 1;
        $user->remember_token = NULL;
        $user->save();

        return redirect('home');
    }
}
