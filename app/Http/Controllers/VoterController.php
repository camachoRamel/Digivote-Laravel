<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    public function create(Request $request){

        $studentValidation = $request->validate([
            'stud_firstname' => 'required|string',
            'stud_middlename' => 'required|string',
            'stud_lastname' => 'required|string',
            'stud_id' => 'required|string|min:10|max:10',
            'stud_cp_num' => 'required'
        ]);
        //fucking fix |regex:/^(\+63|09)\d{9}$/

        $userValidation = $request->validate([
            'username' => 'required|unique:users,username',
            'stud_id' => 'required|string|min:10|max:10',
        ]);

        $student = Student::where('stud_id', Auth::user()->stud_id)->first();
        $user = User::where('user_id', Auth::id());

        $student->update($studentValidation);
        $user->update($userValidation);
        Voter::create(['user_id' => Auth::id()]);

        return redirect()->route('voter.index');
    }
}
