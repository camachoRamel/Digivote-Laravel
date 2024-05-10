<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginLogoutController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if(Auth::user()->role === 1){
                return redirect()->route('admin.index');
            }

            // else if(Auth::user()->role === 1){
            //     return redirect()->route('user.index');
            // }
        }
        return redirect('/')->with('incorrect', 'Incorrect password or username');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }

}
