@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('custom-styles/admin.css') }}">

@section('content')

    {{-- <main class="container bg-light d-flex flex-column gap-4 p-1"> --}}
        <div class="container-fluid">
            <h3 class="fw-bold">Final Voting Time:</h3>
            <p>12:00AM-02/02/24 --- 12:00AM-03/02/24</p>
        </div>
        <div class="container-fluid">
            <div class="row d-flex flex-lg-row flex-column gap-2" id="cards-container">
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Overall Candidates</h5>
                    <div class="d-flex gap-2 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Number of Voters</h5>
                    <div class="d-flex gap-2 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
                <div class="col p-4 shadow d-flex align-items-center">
                    <h5 class="me-auto">Overall Voters</h5>
                    <div class="d-flex gap-2 justify-content-end">
                        <h5 class="fw-bold fs-2">00</h5>
                        <a href="" class="btn btn-outline-dark my-auto">Show all</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- tally -->
        <div class="container shadow py-2 gap-2 position-relative" id="window-container">

            <div class="row">
                <button type="button" class="btn fs-5 ms-auto fw-bold" style="width: fit-content;">ICON</button>
            </div>


            <!-- Tally main container -->
            <div class="row overflow-auto py-3 d-flex gap-2" id="main-tally-container">
               <!-- Rows are added dynamically -->
            </div>

            <a href="" class="btn btn-dark position-absolute bottom-0 end-0 m-5 ">Show all</a>

        </div>
        <!-- tally -->

         <!-- crud -->
        <div class="container shadow candidate-container pt-2 pb-2">

            <div class="row d-flex justify-content-center align-items-center my-3">
                <div class="w-auto bg-secondary fw-bold fs-4 rounded-1 px-3 py-2" id="lc-heading">List of Candidates</div>
            </div>

            <!-- accordion container -->
            <div class="row px-4" id="table-container">
                <table class="table" id="candidate-table"></table>
            </div>

            <div class="row py-2">
                <div class="col d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-secondary">Show All</button>
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

    {{-- </main> --}}

    <script defer src="../custom-scripts/admin.js"></script>

@endsection
