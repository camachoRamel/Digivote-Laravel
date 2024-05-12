<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(int $id)
    {
        $user = DB::table('students')
            ->select('students.*') // Select all columns from the 'users' table
            ->join('users', 'users.stud_id', '=', 'students.stud_id') // Join 'users' and 'posts' tables on user_id
            ->where('students.stud_id', '2022-61595') // Filter by post ID
            ->first(); // Get the first matching user record

        return view('pages.verify', compact('user'));
    }
}
