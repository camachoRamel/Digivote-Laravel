@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    <div class="container col-6 shadow px-4 py-3 rounded-2">
        <h1>Import Students</h1>
        <form action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <label class="input-group-text" for="party_icon">Students Credentials (CSV)</label>
                <input type="file" class="form-control" name="party_icon" id="party_icon">
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark float-right">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection
