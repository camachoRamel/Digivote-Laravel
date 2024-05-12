@extends('layouts.default')
<title>Forgot Password</title>
<link rel="stylesheet" href="../custom-styles/otp.css">

@section('content')
    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-5 px-3">
            <h5 class="m-0">Mobile phone verification</h5>
            <span class="mobile-text">Enter the code we just send on your mobile phone <b class="text-danger">+63 912345678</b></span>
            <div class="d-flex flex-row mt-5">
                <input type="text" class="form-control text-center" maxlength="1" autofocus="">
                <input type="text" class="form-control text-center" maxlength="1">
                <input type="text" class="form-control text-center" maxlength="1">
                <input type="text" class="form-control text-center" maxlength="1">
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center mt-4 gap-1">
                <button class="btn btn-dark text-white" type="submit">Submit</button>
                <span class="d-block mobile-text">Don't receive the code?</span>
                <button type="button" class="btn btn-link btn-sm text-danger cursor p-0">Resend</button>
            </div>
        </div>
    </div>



@endsection
