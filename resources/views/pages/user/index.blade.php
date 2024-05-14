@extends('layouts.user')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    @php
        $count = 0;
        $positions = [ 'President' , 'Vice President', 'Secretary', 'Treasurer', 'Auditor', 'Business Manager', 'Business Manager', 'Business Manager']
    @endphp

    <div class="container">
        <div class="card shadow rounded-2">
            <div class="card-header text-center fs-4 fw-bold">
            Ballot Sheet
            </div>
            <div class="card-body px-5">

                @foreach ($sortedCompiledData as $candidate)

                    @php
                        $candidatePosition = $candidate['candidate']->position_id;
                    @endphp

                    @if ($candidatePosition !== $count)
                        </div>

                        <h5 class="px-5">{{ $positions[$count] }}</h5>

                        <div class="container mb-3 px-5" id="button-group">
                        @php
                            $count = $candidate['candidate']->position_id;
                        @endphp

                    @endif

                    @if ($candidatePosition === $count)
                        <button type="button" class="mb-3 btn btn-outline-dark me-2 vote-btn" value="{{ $candidate['candidate']->candidate_id }}" id="{{ $candidatePosition }}">{{ $candidate['student']->stud_lastname . ", " . $candidate['student']->stud_firstname . " " . $candidate['student']->stud_middlename}}</button>
                    @endif
                @endforeach

                <div class="row mt-3 mb-3">
                    <div class="container-fluid text-end">
                        <button type="button" class="btn btn-dark" id="modal-trigger-btn">Submit</button>
                    </div>
                </div>

            </div>
        </div>

        <form action="" method="POST">
            <!-- Modal -->
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reviewModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modal-body">
                            <!-- modal body info -->
                            <table id="modal-table" class="table table-borderless center-table">
                                <thead>
                                    <th>Position</th>
                                    <th>Name</th>
                                </thead>
                                <tbody id="modal-table-body">
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script defer>
        const csrfToken = "{{ csrf_token() }}";
        const userID = "{{ Auth::id() }}";
    </script>
    <script defer src="{{ asset('custom-scripts/user-voting.js') }}"></script>

@endsection
