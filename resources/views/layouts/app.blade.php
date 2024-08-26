<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     {{-- <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> --}}
     <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
     <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <!-- Custom Styles -->
    <style>
        .navbar-custom {
            background: linear-gradient(180deg, #ffffff 10%, #ffffff 100%) !important;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
        }
        body {
            padding-top: 56px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: rgb(255, 153, 0) !important;
        }

        /* Scrollbar styling */
        /* ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgb(0, 0, 0);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        } */

        /* Ensure table doesn't overflow the container */
        .dataTables_wrapper {
            overflow: auto;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    @stack('scripts')
</body>
</html>