<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('v_login.login');
    }

    public function login (Request $request){ 
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $request->session()->put('title', 'Dashboard');
            return redirect()->route('dashboard')->with('title', 'Dashboard');
        }

        return back()->with('loginError', 'Login failed, please check your credentials');
    }

    public function logout (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('loginPage'));
    }
}
