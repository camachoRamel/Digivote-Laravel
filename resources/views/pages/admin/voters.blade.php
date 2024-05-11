@extends('layouts.app')

@section('content')

    <div class="container shadow py-2 gap-2">
        <table class="table" id="voters-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Year Level</th>
                    <th>Course</th>
                    <th>Cellphone Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->stud_lastname . ", " . $student->stud_firstname . " " . $student->stud_middlename}}</td>
                    <td>{{ $student->stud_course }}</td>
                    <td>{{ $student->stud_year }}</td>
                    <td>{{ $student->stud_cp_num }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script defer src="{{ asset('custom-scripts/voters.js') }}"></script>

@endsection
