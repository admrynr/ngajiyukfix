<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Mail\EmailVerif;
use App\Mail\EmailReset;
use Illuminate\Support\Facades\Mail;

class RegController extends Controller
{
    public function index()
    {
        return view('registerpage');
    }

    public function store(Request $request)
    {
        //kalau pake validate gapapa bagus juga, tapi di view nya dikasih logic untuk nampilin error viewnya
        //udah aku kasih di register page bisa kamu lihat
       
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        
        // nah kodinganmu dibawah mending pake request daripada pake $data[]
        //terus untuk gabungin php gausah array_merge begitu ribet tinggal kamu kasih titik udah bisa kok
        // User::create([
        //     'name' => join(array_merge($data['fname'], $data['lname'])),
        //     'email' => $data['email'],
        //     'is_verified' => '0',
        //     'level' => '2',
        //     'password' => Hash::make($data['password']),
        // ]);
        $user = new User();
        $user->name = $request->fname.' '.$request->lname;
        $user->email = $request->email;
        $user->is_verified = '0';
        $user->level = '3';
        $user->password = Hash::make($request->password);
        $user->save();

        $var = array(
            'name' => $request->fname.' '.$request->lname,
            'id' => $user->id
        );

        Mail::to($data['email'])->send(new EmailVerif($var)); 

        //nah mending pake redirect back sih kalo buat kasus register 
        return redirect()->back()->withErrors(['success' => 'Register success, please check your email for verify your account.']);

    }

    public function verified($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->is_verified = 1;
        $user->update();

        return view('verified');
    }

    public function resetpassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', '=', $email)->first();
        if(!$user)
        {
            return redirect()->route('forgot')->withErrors(['error' => 'Your email is not registered.']);
        }else
        {
            $var = array(
                'name' => $user->name,
                'id' => $user->id
            );
            Mail::to($email)->send(new EmailReset($var));
            return redirect()->route('loginpage')->withErrors(['success' => 'Password reset confirmation has ben sent to your email.']);
        }
    }

    public function reset($id)
    {        
        return view('reset', ['id'=>$id]);
    }

    public function doreset($id, Request $request)
    {
        $user = User::findOrFail($id);
            $user->password = Hash::make($request->newpass);
            $user->update();
            return redirect()->route('loginpage')->withErrors(['success' => 'Password succcessfully reset.']);
    }

}
