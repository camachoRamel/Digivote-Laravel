@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

   <div class="container shadow py-2">
        <form action="" method="POST">
            @foreach ($candidates as $candidate)
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
                        <td class="visibility-hidden">President</td>
                        @break
                    @case(2)
                        <td class="visibility-hidden">Vice President</td>
                        @break
                    @case(3)
                        <td class="visibility-hidden">Secretary</td>
                        @break
                    @case(4)
                        <td class="visibility-hidden">Treasurer</td>
                        @break
                    @case(5)
                        <td class="visibility-hidden">Auditor</td>
                        @break
                    @case(6)
                        <td class="visibility-hidden">Business Manager</td>
                        @break
                    @case(7)
                        <td class="visibility-hidden">Business Manager</td>
                        @break
                @endswitch
            @endforeach
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="president" name="president" placeholder="President" aria-label="President" aria-describedby="president" disabled>
                <button class="btn btn-outline-dark position-btn" type="button" id="president">select candidate</button>
            </div>
        </form>
   </div>

    <script defer src="{{ asset('custom-scripts/admin.js') }}"></script>

@endsection
