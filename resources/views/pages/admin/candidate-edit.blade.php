@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/profile.css') }}">

@section('content')

    <section class="content-header row container-fluid p-0">
        <div class="col p-0">
            <a href=" {{ route('admin.index') }} " class="btn fw-bold fs-2"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
    </section>

    @if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="content container">
        <div class="row">

            <div class="col-10 col-md-6 col-lg-5 mx-auto">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <form action="{{ route('candidate.update', $compiledData['candidate']->candidate_id) }}" method="POST">
                            @csrf
                            <div class="text-center mb-3">
                                <img class="profile-img-test img-fluid" src="{{ asset('images/sample.PNG') }}" alt="User profile picture">
                            </div>

                            <div class="container mb-2">
                                <label for="stud_firstname">Candidate First Name</label>
                                <input type="text" class="form-control" id="stud_firstname" name="stud_firstname" value="{{ $compiledData['student']->stud_firstname }}">
                            </div>

                            <div class="container mb-2">
                                <label for="stud_middlename">Candidate Middle Name</label>
                                <input type="text" class="form-control" id="stud_middlename" name="stud_middlename" value="{{ $compiledData['student']->stud_middlename }}">
                            </div>

                            <div class="container mb-2">
                                <label for="stud_lastname">Candidate Last Name</label>
                                <input type="text" class="form-control" id="stud_lastname" name="stud_lastname" value="{{ $compiledData['student']->stud_lastname }}">
                            </div>

                            <div class="container mb-2">
                                <label for="stud_id">Student ID</label>
                                <input type="text" class="form-control" id="stud_id" name="stud_id" value="{{ $compiledData['candidate']->stud_id }}">
                            </div>

                            <div class="container-fluid d-flex gap-4">
                                <button type="button" class="btn btn-outline-danger w-50" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    Delete
                                </button>
                                <button type="button" class="btn btn-dark w-50" data-bs-toggle="modal" data-bs-target="#updateModal">
                                    Submit
                                </button>
                            </div>

                            <!-- Review Modal -->
                            <div class="modal updateModal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel">Confirm Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        You are about update changes
                                        </div>
                                        {{-- modal body --}}
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Review Modal -->
                        <form action="{{ route('candidate.delete', $compiledData['candidate']->candidate_id) }}" method="POST">
                            @csrf
                            <div class="modal deleteModal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-danger">
                                        You are about to delete this candidate!
                                        </div>
                                        {{-- modal body --}}
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete Candidate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{-- row end --}}


    </section>
    <!-- content end -->

    <section class="content-footer">

    </section>

@endsection
