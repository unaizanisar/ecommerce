<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">

    <style>
        /* Custom Toastr Success Notification */
        .toast-success {
            background-color: #28a745 !important; /* Bootstrap success green */
            color: white !important;
            border: 1px solid #28a745 !important;
        }
        .toast-success .toast-message {
            color: white !important;
        }

        /* Custom Toastr Error Notification */
        .toast-error {
            background-color: #dc3545 !important; /* Bootstrap danger red */
            color: white !important;
            border: 1px solid #dc3545 !important;
        }
        .toast-error .toast-message {
            color: white !important;
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        $(document).ready(function() {
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

    @stack('scripts')
</body>
</html>
