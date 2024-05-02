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
                        <div class="text-center">
                            <img class="profile-img-test img-fluid" src="{{ asset('images/sample.PNG') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">Nina Mcintire</h3>

                        <p class="text-muted text-center">President</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Party Name: </b> Test Party
                            </li>
                            <li class="list-group-item">
                                <b>Party Icon:</b> Test icon
                            </li>
                            <li class="list-group-item">
                                <b>Ballot Number:</b> 102
                            </li>
                            <li class="list-group-item">
                                <b>Candidate ID:</b> 102
                            </li>
                        </ul>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </section>
    <!-- content end -->

    <section class="content-footer">
        view
    </section>

@endsection
