@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

<div class="container shadow candidate-container pt-2 pb-2 h-auto">

    <div class="row d-flex justify-content-start align-items-center my-3 container">
            <div class="col fs-4 fw-bold">List of Candidates</div>
            <div class="col d-flex gap-2 justify-content-end">
                <div class="dropdown">
                    <button type="button" class="btn btn-dark" id="add-dropdown" data-bs-toggle="dropdown" aria-expanded="false">Add Candidate</button>
                    <ul class="dropdown-menu" aria-labelledby="add-dropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.party-add-candidate') }}">By Party</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.position-add-candidate') }}">By position</a></li>
                    </ul>
                </div>
            </div>

    </div>

    <!-- accordion container -->
    <div class="row px-4" id="table-container">

        <table class="table" id="candidate-table">
            <thead>
                <th>Party Icon</th>
                <th>Party Name</th>
                <th class="visibility-hidden">position</th>
                <th>Candidate Name</th>
                <th>Controls</th>
            </thead>
            <tbody>
                @foreach ($compiledData as $data)
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

    {{-- <div class="row py-2">
        <div class="col d-flex gap-2 justify-content-end">
            <div class="dropdown">
                <button type="button" class="btn btn-dark" id="add-dropdown" data-bs-toggle="dropdown" aria-expanded="false">Add</button>
                <ul class="dropdown-menu" aria-labelledby="add-dropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.party-add-candidate') }}">By Party</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.position-add-candidate') }}">By position</a></li>
                </ul>
            </div>
        </div>
    </div> --}}
    {{-- buttons row --}}
      <!-- crud -->

</div>

<script defer src="{{ asset('custom-scripts/list.js') }}"></script>

@endsection
