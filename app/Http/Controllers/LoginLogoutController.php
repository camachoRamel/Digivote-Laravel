<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Voter;


class LoginLogoutController extends Controller
{
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 1) {
                return redirect()->route('admin.index');
            } else if (Auth::user()->role === 0) {
                if (!LoginLogoutController::checkIfVoter(Auth::id())) {
                    //if not yet voter
                    return redirect()->route('user.index', Auth::id());
                }else if(LoginLogoutController::checkIfVoter(Auth::id()) && !LoginLogoutController::checkIfVoted(Auth::id())){
                    return redirect()->route('has.voted');
                }
                return redirect()->route('voter.index', Auth::id());
            }
        }
        return redirect('/')->with('incorrect', 'Incorrect password or username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }

    public function checkIfVoter($id)
    {
        $userCheck = DB::table('voters')
            ->where('user_id', $id)
            ->exists();
        return $userCheck;
    }

    public function checkIfVoted($id)
    {
        if (LoginLogoutController::checkIfVoter($id)) {
            $has_voted = DB::table('voters')
            ->select('has_voted')
            ->where('user_id', $id)->first();
            if ($has_voted == '0') {
                return false;
            }
            return true;
        }
    }
}
