@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    @php
        $count = 0;
        $positions = [ 'President' , 'Vice President', 'Secretary', 'Treasurer', 'Auditor', 'Business Manager', 'Business Manager', 'Business Manager']
    @endphp

   <div class="container shadow py-2">
        <form action="" method="POST">
            @foreach ($sortedCompiledData as $candidate)

                @php
                    $candidatePosition = $candidate['candidate']->position_id;
                @endphp

                @if ($candidatePosition !== $count)
                    <h5>{{ $positions[$count] }}</h5>

                    @php
                        $count = $candidate['candidate']->position_id;
                    @endphp

                @endif

                @if ($candidatePosition === $count)
                    <button type="button" class="btn btn-outline-dark">{{ $candidate['student']->stud_lastname . ", " . $candidate['student']->stud_firstname . " " . $candidate['student']->stud_middlename}}</button>
                @endif
            @endforeach
        </form>
   </div>

    <script defer src="{{ asset('custom-scripts/admin.js') }}"></script>

@endsection
