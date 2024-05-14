@extends('layouts.default')
<title>Forgot Password</title>
<link rel="stylesheet" href="{{ asset('custom-styles/otp.css') }}">

@section('content')
    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-3 px-3">
            <form action="{{ route('forgot.reset', $currUserID->user_id) }}" method="POST">
                @csrf
                <p class="fs-5 fw-bold">Change Password</p>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                    <label for="password">New password:</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password_confirmation" id="confirm_password" placeholder="Confirm Password" required>
                    <label for="password_confirmation">Confirm password:</label>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="row text-end mt-3">
                    <div class="container-fluid">
                        <button type="submit" class="btn btn-dark">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
