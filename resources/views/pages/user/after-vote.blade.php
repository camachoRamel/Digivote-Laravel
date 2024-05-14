@extends('layouts.user')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

<div class="container vh-75 d-flex justify-content-center align-items-center">
    <div class="row d-flex d-flex justify-content-center align-items-center">
        <div class="col-12">
            <div class="card shadow rounded-2">
                <div class="card-header text-center fs-2 fw-bold">
                Thank you for using our platform
                </div>
                <div class="card-body">
                    <p class="fs-4 fw-bold text-center">You have already voted</p>
                </div>
            </div>
        </div>
    </div>


</div>

<script defer src="{{ asset('custom-scripts/user-voting.js') }}"></script>

@endsection
