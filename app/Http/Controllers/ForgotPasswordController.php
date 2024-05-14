<?php

namespace App\Http\Controllers;

// require_once 'vendor\autoload.php';
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\Student;
use App\Models\OneTimePin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('pages.forgot-index');
    }

    public function sendOTP(Request $request)
    {
        $validated = $request->validate([
            'stud_cp_num' => 'required'
        ]);

        if (ForgotPasswordController::checkIfUser($validated['stud_cp_num'])) {
            $user = DB::table('students')
                ->select('students.*') // Select all columns from the 'users' table
                ->join('users', 'users.stud_id', '=', 'students.stud_id') // Join 'users' and 'posts' tables on user_id
                ->where('students.stud_cp_num', $validated['stud_cp_num']) // Filter by post ID
                ->first(); // Get the first matching user record
            $userID = DB::table('users')
                ->select('user_id')
                ->where('stud_id', $user->stud_id)->first();
        } else if (!ForgotPasswordController::checkIfUser($validated['stud_cp_num'])) {
            return view('pages.forgot-index')->with('!exist', 'No students registered with number.');
        }


        ForgotPasswordController::send($userID->user_id);
        return view('pages.otp', compact('user', 'userID'));
    }

    public function checkIfUser($phoneNum)
    {
        $userCheck = DB::table('students')
            ->where('stud_cp_num', $phoneNum)
            ->exists();

        return $userCheck;
    }

    public function checkOTP(Request $request, $id)
    {

        $validated = $request->validate([
            'one' => 'required',
            'two' => 'required',
            'three' => 'required',
            'four' => 'required'
        ]);
        $otp = $validated['one'] . $validated['two'] . $validated['three'] . $validated['four'];
        $idExist = DB::table('otps')
        ->where('user_id', $id)
        ->exists();
        $otpExist = DB::table('otps')
        ->where('otp', $otp)
        ->exists();
        if($idExist && $otpExist){
            //redicrect to change password
        }

        return redirect()->back()->with('incorrect', 'Wrong OTP');


    }

    public function send($id)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "+639121733929", // to
                array(
                    "from" => env('TWILIO_PHONE'),
                    "body" => ForgotPasswordController::createOTP($id)
                )
            );
    }


    public function createOTP($id)
    {
        $otp = rand(0, 9999);
        if ($otp < 1000) {
            $otp = str_pad($otp, 4, '0');
        }
        OneTimePin::create(['otp' => $otp, 'user_id' => $id]);
        return $otp;
    }
}
