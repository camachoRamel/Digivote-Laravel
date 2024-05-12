@extends('layouts.default')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif
@section('content')
<div class="container d-flex vh-100 justify-content-center align-items-center">
    <form action="{{ route('voter.create') }}" method="POST" class="shadow p-5 bg-white rounded-4 d-flex flex-column gap-3">
        @csrf
        <h3>Review your personal Information</h3>
        <div class="container">
            <label for="fullname"> Fullname</label>
            <input name="stud_firstname" class="form-control" type="text" value="{{ $user->stud_firstname }}" aria-label=".form-control-lg example">
        </div>
        <div class="container">
            <label for="fullname"> Fullname</label>
            <input name="stud_middlename" class="form-control" type="text" value="{{ $user->stud_middlename }}" aria-label=".form-control-lg example">
        </div>
        <div class="container">
            <label for="fullname"> Fullname</label>
            <input name="stud_lastname" class="form-control" type="text" value="{{ $user->stud_lastname }}" aria-label=".form-control-lg example">
        </div>
        <div class="container">
            <label for="username">Username</label>
            <input name="username" class="form-control" type="text" value="{{ Auth::user()->username }}" aria-label=".form-control-lg example">
        </div>
        <div class="container">
            <label for="student-id">Student ID</label>
            <input name="stud_id" class="form-control" type="text" value="{{ $user->stud_id }}" aria-label=".form-control-lg example">
        </div>
        <div class="container">
            <label for="cp-number">Cellphone Number</label>
            <input name="stud_cp_num" class="form-control" type="tel" value="{{ $user->stud_cp_num }}" aria-label=".form-control-lg example">
        </div>
        <div class="container d-flex justify-content-end mt-2">
            <button name="submit" type="submit" class="btn btn-submit btn-dark">Submit</button>
        </div>
    </form>
</div>

@endsection
