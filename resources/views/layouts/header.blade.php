<link rel="stylesheet" href="{{ asset('custom-styles/header.css') }}">
   <header>
        <nav class="navbar navbar-expand-lg py-3 px-1 navbar-light px-lg-3">
            <div class="container-fluid">
                <a href="" class="navbar-brand text-dark fw-bold fs-2">Digivote</a>

                <div class="container-1 justify-content-end d-flex d-lg-none flex-lg-row-reverse gap-2">
                    <div class="rounded-circle border border-dark text-center position-relative" id="user-profile-container">
                        IMG
                        <div class="position-absolute" id="profile-name-container">kurdapya</div>
                    </div>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse justify-content-end gap-3" id="main-nav">
                    <ul class="navbar-nav gap-2">
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Poll</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Candidates</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Voted</a>
                        </li>
                    </ul>
                    <div class="rounded-circle d-lg-flex border border-dark justify-content-center position-relative d-none" id="user-profile-container">
                        IMG
                        <div class="position-absolute" id="profile-name-container">kurdapya</div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
