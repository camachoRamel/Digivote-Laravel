@extends('layouts.default')
<title>Forgot Password</title>
<link rel="stylesheet" href="{{ asset('custom-styles/otp.css') }}">

@section('content')
    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-5 px-3">
            <form action="{{ route('send.otp')}}" method="get">
                @csrf
                <p class="fs-5 fw-bold">Enter your Phone Number</p>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="stud_cp_num" id="stud_cp_num" placeholder="Username" maxlength="11">
                    <label for="stud_cp_num">Number</label>
                    <div id="passwordHelpBlock" class="form-text">Eg: 09123456789</div>
                </div>
                @if (session()->has('!exist'))
                    <p class="text-danger">{{ session('!exist') }}</p>
                @endif
                <div class="row text-end">
                    <div class="container-fluid">
                        <button type="submit" class="btn btn-dark">Send OTP</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- regex: ^09\d{9}$ --}}
