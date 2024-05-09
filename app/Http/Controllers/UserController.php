<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::select('user_id', 'username', 'password')->get();
        return view('pages.admin.voters', compact('users'));
    }
}
