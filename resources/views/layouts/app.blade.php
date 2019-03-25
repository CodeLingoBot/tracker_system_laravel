<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <style>
        body{
            background-color: {{\App\Setting::val('cor-de-fundo', '#FBF8EF')}};
        }
        .bg-light {
            color:{{\App\Setting::val('cor-barras-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-barras', '#09606F')}} !important;
        }
        .card>.card-header{
            background-color: {{\App\Setting::val('cor-barras', '#09606F')}};
        }
        .bg-primary, .list-group-item.active, .page-item.active > .page-link{
            color:{{\App\Setting::val('cor-primaria-texto', '#fff')}} !important;
            border-color: {{\App\Setting::val('cor-primaria', 'black')}};
            background-color: {{\App\Setting::val('cor-primaria', 'black')}};
        }
    </style>
    @yield('template_linked_css')
    @yield('stylesheets')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="wrapper" class="d-flex">
        @include('layouts._navbar')
        @if (!Auth::guest())
            @include('layouts._sidebar')
        @endif
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>
    @include('laravelusers::scripts.toggleText')
    @yield('template_scripts')
    @yield('scripts')
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>