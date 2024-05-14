@extends('layouts.default')
<title>Forgot Password</title>
<link rel="stylesheet" href="{{ asset('custom-styles/otp.css') }}">

@section('content')
    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-5 px-3">
            <form action="{{ route('check.otp', $userID->user_id)  }}" method="POST">
                @csrf
                <h5 class="m-0">Mobile phone verification</h5>
                <span class="mobile-text">Enter the code we just send on your mobile phone <b class="text-danger">{{$user->stud_cp_num}}</b></span>
                <div class="d-flex flex-row mt-5">
                    <input name="one" type="text" class="form-control text-center" maxlength="1" autofocus="">
                    <input name="two" type="text" class="form-control text-center" maxlength="1">
                    <input name="three" type="text" class="form-control text-center" maxlength="1">
                    <input name="four" type="text" class="form-control text-center" maxlength="1">
                </div>
                @if (session()->has('incorrect'))
                    <span class="text-danger">{{session('incorrect')}}</span>
                @endif
                <div class="d-flex flex-column justify-content-center align-items-center mt-4 gap-1">
                    <a type="button" href="{{ route('forgot.index') }}" class="btn btn-link btn-sm text-primary cursor p-0">Change Number</a>
                    <button class="btn btn-dark text-white" type="submit">Submit</button>
                    <span class="d-block mobile-text">Don't receive the code?</span>
                    <a type="button" href="{{ route('send.otp') }}" class="btn btn-link btn-sm text-danger cursor p-0">Resend</a>
                </div>
            </form>
        </div>
    </div>
@endsection
