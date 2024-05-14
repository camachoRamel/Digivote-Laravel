<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('custom-styles/header.css') }}">

    {{-- <title>{{ $pageTitle}}</title> --}}
</head>

<body class="bg-light pb-5">

   <header>
        <nav class="navbar navbar-expand-lg py-3 px-1 navbar-light px-lg-3">
            <div class="container-fluid">
                <a href="" class="navbar-brand text-dark fw-bold fs-2">Digivote</a>

                <div class="container-1 justify-content-end d-flex gap-2">

                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="row">
                            <div class="rounded-circle border border-dark text-center btn dropstart" id="user-profile-container" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                {{-- <img src="{{ asset('images/profile.jpg') }}" alt="user prof"> --}}
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li class="p-0">
                                        <form action="{{ route('logout') }}" method="post" id="logout-form-1">
                                            @csrf
                                            <button id="logout-btn" type="submit" class="btn">Log out</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div>{{ Auth::user()->username }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <div class="content container d-flex flex-column justify-content-center align-items-center gap-4 p-1    ">
        @yield('content')
    </div>

    <script>
        const buttons = document.querySelectorAll("#logout-btn");

        buttons.forEach(function(button) {
            button.addEventListener("click", function() {
                document.getElementById('logout-form-1').submit();
                document.getElementById('logout-form-2').submit();
            });
        });
    </script>
    <script src="{{ asset('jquery/jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('data-table/js/dataTables.js')}}"></script>
</body>
</html>
