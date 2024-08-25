<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     * 
     *
     * @return void
     */


     public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin2.products');
        } else {
            Auth::logout();
            return redirect()->route('admin.login')->with('message','You are not authorized to access this page');;
        }
    } else {
        return redirect()->route('admin.login')->withErrors(['Invalid credentials']);
    }
}

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
