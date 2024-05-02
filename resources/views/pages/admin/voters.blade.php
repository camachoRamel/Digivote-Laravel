@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/profile.css') }}">

@section('content')

    <div class="container">
        test
        @foreach ($users as $user)
            <div class="">
                {{ $user['user_id'] }}
                {{ $user['username'] }}
                {{ $user['password'] }}
            </div>

        @endforeach
    </div>

@endsection
