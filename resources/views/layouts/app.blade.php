<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('data-table/css/dataTables.bootstrap5.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    {{-- <title>{{ $pageTitle}}</title> --}}
</head>

<body>

    @yield('content')


</body>

    <script src="{{ asset('jquery/jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('data-table/js/dataTables.js')}}"></script>

</html>
