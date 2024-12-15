<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login (Request $request){
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if (Auth::attempt($credentials)){
            if (Auth::user()->role == 'admin'){
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard')->with(['title', 'Dashboard']);
            } else if (Auth::user()->role == 'staff'){
                $request->session()->regenerate();
                return redirect()->route('staff.dashboard');
            } else {
                $request->session()->regenerate();
                return redirect()->route('user.dashboard');
            }
        }

        return back()->with('loginError', 'Login failed, please check your credentials');
    }

    public function logout (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage');
    }
}
