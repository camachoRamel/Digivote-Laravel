@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/profile.css') }}">

@section('content')

    <section class="content-header row container-fluid p-0">
        <div class="col p-0">
            <a href=" {{ route('admin.index') }} " class="btn fw-bold fs-2"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
    </section>

    <section class="content container">
        <div class="row">

            <div class="col-10 col-md-6 col-lg-5 mx-auto">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <form action="">
                            <div class="text-center mb-3">
                                <img class="profile-img-test img-fluid" src="{{ asset('images/sample.PNG') }}" alt="User profile picture">
                            </div>

                            <div class="container mb-2">
                                <input type="text" class="form-control" value="Nina Mcintre">
                            </div>

                            <div class="container mb-2">
                                <input type="text" class="form-control" value="President">
                            </div>

                            <div class="container mb-2">
                                <input type="text" class="form-control" value="Student ID">
                            </div>

                            <div class="container-fluid d-flex gap-4">
                                <button type="button" class="btn btn-outline-danger w-50" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    Delete
                                </button>
                                <button type="button" class="btn btn-dark w-50" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                    Submit
                                </button>
                            </div>

                            <!-- Review Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
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
                                        <button type="button" class="btn btn-danger">Delete Candidate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Modal -->
                            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabel">Confirm Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        You are about update changes
                                        </div>
                                        {{-- modal body --}}
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
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
        edit
    </section>

@endsection
