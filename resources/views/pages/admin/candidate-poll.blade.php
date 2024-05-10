@extends('layouts.app')

@section('content')

<div class="container shadow py-2 gap-2 h-auto">

    <div class="row">
        <div class="container fs-4 fw-bold">
            Tally of Candidates
        </div>
        {{-- <button type="button" class="btn fs-5 ms-auto fw-bold" style="width: fit-content;">ICON</button> --}}
    </div>

    <!-- Tally main container -->
    <div class="row px-4 mb-2" id="tally-window">

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
                @foreach ($compiledData as $data)
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

</div>

<script defer src="{{ asset('custom-scripts/poll.js') }}"></script>

@endsection
