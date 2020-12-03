<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use App\User;
use Hash;

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

    //use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
            Auth::logout();
    return redirect('/login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function authenticate(Request $request)
    {
        if (Auth::validate(['email'=>$request->email, 'password'=>$request->password])) {
            $cekuser = User::where('email',$request->email)->first();
            if($cekuser->is_verified==1){
                Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);
                if ($cekuser->level==1){
                    return redirect()->route('dashboard.index');
                }else if ($cekuser->level==3){
                    return redirect()->route('dashboard');
                }
            }else{
                return redirect()->back()->withErrors(['error' => 'Please verify your account first !']);
            }
        }else{
            return redirect()->back()->withErrors(['error' => 'Email or password is wrong !']);
        }

    }

    public function authenticateadmin(Request $request)
    {
        if(Auth::validate(['email' => $request->email,'password' => $request->password])){
            $cekuser = User::where('email',$request->email)->first();
            //dd($cekuser);
            if($cekuser->level == 0)
            return redirect()->back()->withErrors(['error' => 'You have no permission!']);
            else
            if($cekuser->is_verified == 1){
                Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);
                return redirect()->route('home');
            }else{
                return redirect()->back()->withErrors(['error' => 'Please verify your account first !']);
            }
        }else{
            return redirect()->back()->withErrors(['error' => 'Email or password is wrong!']);
        }

    }

    //user unverified
    public function unverify()
    {
        Session::flash('message', 'Wait until your account is verified before you can login.');
            return view('Auth.login');
    }

    //wrong authentication
    public function wrong()
    {
        Session::flash('message', 'Username or password is incorrect');
            return view('Auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
}
