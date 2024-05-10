<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        // $user = User::select('');
        return view('pages.admin.index');
    }
}
