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

                        @php
                            $party = $compiledData['party'];
                            $candidate = $compiledData['candidate'];
                            $student = $compiledData['student'];
                            $candidatePosition = $compiledData['candidate']->position_id;
                        @endphp

                        <h3 class="profile-username text-center">{{ $student->stud_firstname . " " .  $student->stud_middlename . " ". $student->stud_lastname  }}</h3>

                        @switch($candidatePosition)
                        @case(1)
                            <p class="text-muted text-center">President</p>
                            @break
                        @case(2)
                            <p class="text-muted text-center">Vice President</p>
                            @break
                        @case(3)
                            <p class="text-muted text-center">Secretary</p>
                            @break
                        @case(4)
                            <p class="text-muted text-center">Treasurer</p>
                            @break
                        @case(5)
                            <p class="text-muted text-center">Auditor</p>
                            @break
                        @case(6)
                            <p class="text-muted text-center">Business Manager 1</p>
                            @break
                        @case(7)
                            <p class="text-muted text-center">Business Manager 2</p>
                            @break
                        @endswitch
                        {{-- <p class="text-muted text-center">President</p> --}}

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Party Name: </b> {{ $party->party_name ?? 'No Party'}}
                            </li>
                            <li class="list-group-item">
                                <b>Party Icon:</b> {{ $party->party_icon ?? 'No Party'}}
                            </li>
                            <li class="list-group-item">
                                <b>Candidate ID:</b> {{ $candidate->candidate_id }}
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

    </section>

@endsection
