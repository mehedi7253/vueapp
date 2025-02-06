<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet"> --}}
        @endif
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>

        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> --}}
    </body>
</html>
