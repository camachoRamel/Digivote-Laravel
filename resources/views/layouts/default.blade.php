<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}">


    {{-- <title>{{ $pageTitle}}</title> --}}
</head>

<body class="bg-light pb-5">

        <div class="content container d-flex flex-column justify-content-center align-items-center gap-4 p-1    ">
            @yield('content')
        </div>



</body>
    {{-- <script src="{{ asset('jquery/jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('data-table/js/dataTables.js')}}"></script> --}}
</html>
