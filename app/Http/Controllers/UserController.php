<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    public function index(int $id)
    {
        $userStudID = DB::table('users')
        ->select('stud_id')
        ->where('user_id', $id);

        $user = DB::table('students')
            ->select('students.*') // Select all columns from the 'users' table
            ->join('users', 'users.stud_id', '=', 'students.stud_id') // Join 'users' and 'posts' tables on user_id
            ->where('students.stud_id', $userStudID) // Filter by post ID
            ->first(); // Get the first matching user record

        return view('pages.verify', compact('user'));
    }

    public function create(Request $request){
        $validated = $request->validate([
            'file_name' => [
                'required',
                File::types('csv')
            ]
            ]);

        $request->file('file_name')->storeAs($request->file('file_name')->getClientOriginalName());
        $path = Storage::path($request->file('file_name')->getClientOriginalName());
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        foreach($csv as $record){
            $student = [
                'stud_id' => $record['stud_id'],
                'stud_firstname' => $record['stud_firstname'],
                'stud_middlename' => $record['stud_middlename'],
                'stud_lastname' => $record['stud_lastname'],
                'stud_course' => $record['stud_course'],
                'stud_year' => $record['stud_year'],
                'stud_cp_num' => $record['stud_cp_num']
            ];

            $user = [
                'stud_id' => $record['stud_id'],
                'username' => $record['stud_cp_num'],
                'password' => $record['stud_id'],
            ];


            if(!Student::where('stud_id', $student['stud_id'])->exists()){
                Student::create($student);
            }
            if(!User::where('stud_id', $student['stud_id'])->exists()){
                User::create($user);
            }

        }

        return redirect()->route('admin.index')->with('success', 'Accounts successfully created.');


    }
}
