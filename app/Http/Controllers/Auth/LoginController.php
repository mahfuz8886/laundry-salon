<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        if(Auth::check() && Auth::user()->role->id==1) {
            $this->redirectTo=route('superadmin.main_dashboard');
        }elseif(Auth::check() && Auth::user()->role->id==2){
            $this->redirectTo=route('superadmin.main_dashboard');     
        }elseif(Auth::check() && Auth::user()->role->id==3){
            $this->redirectTo=route('superadmin.main_dashboard');     
        }elseif(Auth::check() && Auth::user()->role->id==4){
            $this->redirectTo=route('superadmin.main_dashboard');     
        }else{
            $this->redirectTo=route('superadmin.main_dashboard');    
        }
        
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backEnd.setting.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $checkAuth = User::where('email', $request->email)
            ->orWhere('phone', $request->email)
            ->first();
        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                Toastr::warning('warning', 'Opps! your account has been suspends');
                return redirect()->back()->with('error', 'Opps! your account has been suspends');
            } else {
                if (password_verify($request->password, $checkAuth->password)) {
                    Auth::login($checkAuth);
                    Toastr::success('success', 'Thanks , You are login successfully');
                    return redirect('superadmin/main_dashboard');
                } else {
                    Toastr::error('Opps!', 'Sorry! your password wrong');
                    return redirect()->back()->with('error', 'Sorry! your password wrong');
                }
            }
        } else {
            // Toastr::error('Opps!', 'Opps! you have no account');
            return redirect()->back()->with('error', 'Opps! you have no account');
        }
    }

    protected function CustomRedirectUserPath(){
        if(Auth::user()->role_id==1){
            return redirect('superadmin/main_dashboard');
        }elseif(Auth::user()->role_id==2){
            return redirect('superadmin/main_dashboard');
        }elseif(Auth::user()->role_id==3){
            return redirect('superadmin/main_dashboard');
        }elseif(Auth::user()->role_id==4){
            return redirect('superadmin/main_dashboard');
        }
    }
}
