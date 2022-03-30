<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Notifications\VerifyRegistration;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $this->validateLogin($request);
        $user = User::where('email', $request->email)->first();

        if(empty($user)){

        }
        else{
            if(Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
                //if user is verified
                if($user->status == 1){
                    session()->flash('success', 'Login successfully');
                    return $this->sendLoginResponse($request);
                }
                //if user isn't verified
                else{
                    $user->notify(new VerifyRegistration($user, $user->remember_token));
                    session()->flash('success', 'Confirmation mail has been sent to you');
                    return redirect('/');
                }
            }
            else{
                return redirect()->route('home');
            }
        }
    }

    public function validateLogin(){

    }
}
