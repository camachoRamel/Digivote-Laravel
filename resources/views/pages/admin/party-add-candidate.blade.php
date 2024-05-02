@extends('layouts.app')

@section('content')

    <div class="row container-fluid p-0">
        <div class="col p-0">
            <a href=" {{ route('admin.index') }} " class="btn fw-bold fs-2"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{--  py-5 px-4  --}}

    <section class="row container-fluid">
        <div class="col-12 col-lg-7">
            <form action="{{ route('candidate.save') }}" method="POST">
                @csrf
                <div class="border border-dark rounded-3 p-3" id="candidate-list-container">
                    {{-- party name container --}}
                    <div class="mb-3">
                        <input type="text" class="form-control" id="party_name" name="party_name" placeholder="Party Name">
                    </div>
                    {{-- party icon container --}}
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="party_icon">Party Icon</label>
                        <input type="file" class="form-control" name="party_icon" id="party_icon">
                    </div>
                    {{-- president container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="president" name="president" placeholder="President" aria-label="President" aria-describedby="president" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="president">select candidate</button>
                    </div>
                    {{-- vice president container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="vice_president" name="vice_president" placeholder="Vice President" aria-label="Vice President" aria-describedby="vice_president" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="vice_president">select candidate</button>
                    </div>
                    {{-- secretary container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="secretary" name="secretary" placeholder="Secretary" aria-label="Secretary" aria-describedby="secretary" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="secretary">select candidate</button>
                    </div>
                    {{-- treasurer container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="treasurer" name="treasurer" placeholder="Treasurer" aria-label="Treasurer" aria-describedby="treasurer" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="treasurer">select candidate</button>
                    </div>
                    {{-- auditor container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="auditor" name="auditor" placeholder="Auditor" aria-label="Auditor" aria-describedby="auditor" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="auditor">select candidate</button>
                    </div>
                    {{-- business manager 1 container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="business_manager_1" name="business_manager_1" placeholder="Business Manger 1" aria-label="Business Manger 1" aria-describedby="business_manager_1" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="business_manager_1">select candidate</button>
                    </div>
                    {{-- business manager 2 container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="business_manager_2" name="business_manager_2" placeholder="Business Manger 2" aria-label="Business Manger 2" aria-describedby="business_manager_2" disabled>
                        <button class="btn btn-outline-dark position-btn" type="button" id="business_manager_2">select candidate</button>
                    </div>

                    <button type="button" class="btn btn-dark w-100 mt-2" id="modal-trigger-btn" data-bs-toggle="modal" data-bs-target="#reviewModal">Submit</button>

                    <!-- Modal -->
                    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
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
                                            <th>Student ID</th>
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
                </div>
            </form>
        </div>
        {{-- semi-form col --}}

        <div class="col-12 col-lg-5">
            <div class="border border-dark rounded-3 p-3" id="student-table-container">
                <table id="selectionTable" class="table"></table>
            </div>
        </div>
        {{-- table col --}}
    </section>

    <script defer>
          const csrfToken = "{{ csrf_token() }}";
    </script>
    <script defer src="{{ asset('custom-scripts/party-add-candidate.js') }}"></script>

@endsection
