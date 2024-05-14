{{-- @extends('layouts.default')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="new_password" id="new_password" placeholder="name@example.com">
                <label for="new_password">New password:</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password">
                <label for="confirm_password">Confirm password:</label>
            </div>
        </div>
    </div>

@endsection --}}

@extends('layouts.default')
<title>Forgot Password</title>
<link rel="stylesheet" href="{{ asset('custom-styles/otp.css') }}">

@section('content')
    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-3 px-3">
            <form action="{{ route('forgot-password') }}" method="get">
                @csrf
                <p class="fs-5 fw-bold">Enter your Phone Number</p>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="new_password" id="new_password" placeholder="name@example.com">
                    <label for="new_password">New password:</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password">
                    <label for="confirm_password">Confirm password:</label>
                </div>
                <div class="row text-end mt-3">
                    <div class="container-fluid">
                        <button type="submit" class="btn btn-dark">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
