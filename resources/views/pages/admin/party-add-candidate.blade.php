@extends('layouts.app')

@section('content')

    <div class="row container-fluid p-0">
        <div class="col p-0">
            <a href=" {{ route('admin.index') }} " class="btn fw-bold fs-2"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
    </div>

    {{--  py-5 px-4  --}}

    <section class="row container-fluid">
        <div class="col-12 col-lg-7">
            <form action="">
                <div class="border border-dark rounded-3 p-3" id="candidate-list-container">
                    {{-- party name container --}}
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="party_name" name="party_name" placeholder="name@example.com">
                        <label for="party_name">Party Name</label>
                    </div>
                    {{-- party icon container --}}
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="party_icon">Party Icon</label>
                        <input type="file" class="form-control" name="party_icon" id="party_icon">
                    </div>
                    {{-- president container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="President" aria-label="President" aria-describedby="president" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="president" name="president">select candidate</button>
                    </div>
                    {{-- vice president container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Vice President" aria-label="Vice President" aria-describedby="vice_president" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="vice_president" name="vice_president">select candidate</button>
                    </div>
                    {{-- secretary container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Secretary" aria-label="Secretary" aria-describedby="secretary" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="secretary" name="secretary">select candidate</button>
                    </div>
                    {{-- treasurer container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Treasurer" aria-label="Treasurer" aria-describedby="treasurer" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="treasurer" name="treasurer">select candidate</button>
                    </div>
                    {{-- auditor container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Auditor" aria-label="Auditor" aria-describedby="auditor" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="auditor" name="auditor">select candidate</button>
                    </div>
                    {{-- business manager 1 container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Business Manger 1" aria-label="Business Manger 1" aria-describedby="business_manager_1" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="business_manager_1" name="business_manager_1">select candidate</button>
                    </div>
                    {{-- business manager 2 container --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Business Manger 2" aria-label="Business Manger 2" aria-describedby="business_manager_2" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="business_manager_2" name="business_manager_2">select candidate</button>
                    </div>
                    {{-- <!-- president container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>President: </h4>
                        <span class="fs-4 fw-bold" id="president-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="president">select candidate</button>
                    </span>
                    <!-- vice president container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>Vice President: </h4>
                        <span class="fs-4 fw-bold" id="vicePresident-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="vicePresident">select candidate</button>
                    </span>
                    <!-- secretary container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>Secretary: </h4>
                        <span class="fs-4 fw-bold" id="secretary-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="secretary">select candidate</button>
                    </span>
                    <!-- treasurer container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>Treasurer: </h4>
                        <span class="fs-4 fw-bold" id="treasurer-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="treasurer">select candidate</button>
                    </span>
                    <!-- auditor container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>Auditor: </h4>
                        <span class="fs-4 fw-bold" id="auditor-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="auditor">select candidate</button>
                    </span>
                    <!-- business manager 1 container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>Business Manager 1: </h4>
                        <span class="fs-4 fw-bold" id="businessManager1-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="businessManager1">select candidate</button>
                    </span>
                    <!-- business manager 2 container -->
                    <span class="d-flex align-items-center gap-2 py-2 px-3 border border-dark rounded-3 mt-2">
                        <h4>Business Manager 2: </h4>
                        <span class="fs-4 fw-bold" id="businessManager2-candidate"></span>
                        <button type="button" class="btn btn-outline-dark position-btn ms-auto" id="businessManager2">select candidate</button>
                    </span> --}}
                    <button type="submit" class="btn btn-dark w-100 mt-2" id="modal-trigger-btn" data-bs-toggle="modal" data-bs-target="#reviewModal">Submit</button>
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
                <button type="button" class="btn btn-dark" id="submitBtn">Submit</button>
            </div>
            </div>
        </div>
    </div>

    <script defer src="{{ asset('custom-scripts/party-add-candidate.js') }}"></script>

@endsection
