@extends('layouts.app')

@section('content')

    <div class="row container-fluid p-0">
        <div class="col p-0">
            <a href=" {{ route('admin.index') }} " class="btn fw-bold fs-2"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
    </div>

    <section class="container row d-flex justify-content-center" id="main-container">
        <form class="col-12 col-lg-8">
            <p class="fw-bold fs-5">By Position Add Candidate</p>
            <select class="form-select w-100" aria-label="Default select example">
                <option value="president">President</option>
                <option value="vice_president">Vice-President</option>
                <option value="secretary">Secretary</option>
                <option value="treasurer">Treasurer</option>
                <option value="auditor">Auditor</option>
                <option value="business_manager_1">Business Manager</option>
            </select>

            <div class="row mt-2 border border-dark rounded-2 py-2 px-3">
                <div class="fw-bold">Selected Candidates Table</div>
                <table id="selectedTable" class="table"></table>
            </div>
            <div class="row mt-2 border border-dark rounded-2 py-2 px-3">
                <div class="fw-bold">List of Students</div>
                <table id="selectionTable" class="table"></table>
            </div>

            <div class="row d-flex justify-content-end">
                <button type="button" class="btn btn-dark mt-2" id="modal-trigger-btn">
                Submit
                </button>

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

                            <table id="modal-table" class=" w-50 mx-auto table table-borderless center-table"></table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- col --}}
    </section>

    <script defer>
        const csrfToken = "{{ csrf_token() }}";
        const saveCandidate = "{{ route('candidate.save') }}"
    </script>
    <script defer src="{{ asset('custom-scripts/position-add-candidate.js') }}"></script>

@endsection
