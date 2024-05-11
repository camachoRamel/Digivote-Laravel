@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    @if (session()->has('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session()->has('danger'))
    <div class="alert alert-danger mt-3" role="alert">
        {{ session('danger') }}
    </div>
    @endif
        <div class="container-fluid d-flex justify-content-end">
            <a class="btn btn-outline-dark" href="{{ route('import.students') }}">Import Students</a>
        </div>
        <div class="container-fluid">
            <h3 class="fw-bold">Final Voting Time:</h3>
            <p>12:00AM-02/02/24 --- 12:00AM-03/02/24</p>
        </div>
        <div class="container-fluid">
            <div class="row d-flex flex-lg-row flex-column gap-2" id="cards-container">
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Overall Candidates</h5>
                    <div class="d-flex gap-3 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="{{ route('candidate.list') }}" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
                {{-- <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Number of Voters</h5>
                    <div class="d-flex gap-2 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="{{ route('admin.voters') }}" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div> --}}
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Overall Voters</h5>
                    <div class="d-flex gap-3 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="{{ route('voters') }}" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- tally -->
        <div class="container shadow py-2 gap-2" id="window-container">

            <div class="row">
                <div class="container fs-4 fw-bold">
                    Tally of Candidates
                </div>
                {{-- <button type="button" class="btn fs-5 ms-auto fw-bold" style="width: fit-content;">ICON</button> --}}
            </div>

            <!-- Tally main container -->
            <div class="row px-4 mb-2">

                <table class="table table-borderless" id="tally-table">
                    <thead>
                        <tr>
                            <th class="col-4">Candidate</th>
                            <th class="col-6">Poll</th>
                            <th class="col-2">Votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($sortedCompiledData as $data)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td class="fs-5 fw-bold">{{ $data['student']->stud_lastname }}, {{ $data['student']->stud_firstname }} {{ $data['student']->stud_middlename }}</td>
                                <td>
                                    <div class="progress rounded-0 me-auto">
                                        <div class="progress-bar {{ "{$count}" }}" id="progress" role="progressbar">
                                        </div>
                                    </div>
                                </td>
                                <td class="fs-5 fw-bold">{{ $data['candidate']->vote }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('candidate.poll') }}" class="btn btn-dark ">Show all</a>
            </div>

        </div>
        <!-- tally -->

         <!-- crud -->
        <div class="container shadow candidate-container pt-2 pb-2">

            <div class="row d-flex justify-content-center align-items-center my-3">
                <div class="w-auto bg-secondary fw-bold fs-4 rounded-1 px-3 py-2" id="lc-heading">List of Candidates</div>
            </div>

            <!-- accordion container -->
            <div class="row px-4" id="table-container">

                <table class="table" id="candidate-table">
                    <thead>
                        <th>Party Icon</th>
                        <th>Party Name</th>
                        <th>Position</th>
                        <th>Candidate Name</th>
                        <th>Controls</th>
                    </thead>
                    <tbody>
                        @foreach ($sortedCompiledData as $data)
                        <tr>
                            @php
                                $party =  $data['party'];
                                $candidatePosition = $data['candidate']->position_id;
                                $candidateID = $data['candidate']->candidate_id;
                                $partyIcon = $data['party']->party_img ?? null;
                                $votes = $data['candidate']->vote;
                            @endphp

                            @if($party !== null)
                                <td> <img src="{{ asset('images/' . $partyIcon) }}" class="rounded-circle" id="party-icon" alt="party icon"> </td>
                                <td>{{ $data['party']->party_name }}</td>
                            @else
                                <td>No Party</td>
                                <td>No Party</td>
                            @endif

                            @switch($candidatePosition)
                                @case(1)
                                    <td>President</td>
                                    @break
                                @case(2)
                                    <td>Vice President</td>
                                    @break
                                @case(3)
                                    <td>Secretary</td>
                                    @break
                                @case(4)
                                    <td>Treasurer</td>
                                    @break
                                @case(5)
                                    <td>Auditor</td>
                                    @break
                                @case(6)
                                    <td>Business Manager</td>
                                    @break
                                @case(7)
                                    <td>Business Manager</td>
                                    @break
                            @endswitch

                            <td>{{ $data['student']->stud_lastname }}, {{ $data['student']->stud_firstname }} {{ $data['student']->stud_middlename }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('candidate.view', $candidateID) }}" class="btn btn-secondary">View <i class="bi bi-eye"></i></a>
                                <a href="{{ route('candidate.edit', $candidateID) }}"  class="btn btn-dark">Edit <i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row py-2">
                <div class="col d-flex gap-2 justify-content-end">
                    <a href="{{ route('candidate.list') }}" class="btn btn-secondary">Show all</a>
                    <div class="dropdown">
                        <button type="button" class="btn btn-dark" id="add-dropdown" data-bs-toggle="dropdown" aria-expanded="false">Add</button>
                        <ul class="dropdown-menu" aria-labelledby="add-dropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.party-add-candidate') }}">By Party</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.position-add-candidate') }}">By position</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- buttons row --}}
              <!-- crud -->

        </div>

    <script defer src="{{ asset('custom-scripts/admin.js') }}"></script>

@endsection
