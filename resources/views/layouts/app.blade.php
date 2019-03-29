@extends('adminlte::page')

@section('content')
    <div id="loading">
        <div class="lds-hourglass"></div>
    </div>
@stop

@section('css')
<!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <style>
        body{
            background-color: {{\App\Setting::val('cor-de-fundo', '#FBF8EF')}} !important;
        }
        .card-header, [class*="light"] {
            color:{{\App\Setting::val('cor-barras-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-barras', '#343a40')}} !important;
            border: none;
        }
        [class*="primary"], [class*="primary"]:hover {
            color:{{\App\Setting::val('cor-primaria-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-primaria', '#007bff')}} !important;
            border: none;
        }
        [class*="secondary"], [class*="secondary"]:hover {
            color:{{\App\Setting::val('cor-secundaria-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-secundaria', '#6c757d')}} !important;
            border: none;
        }
        [class*="success"], [class*="success"]:hover {
            color:{{\App\Setting::val('cor-sucesso-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-sucesso', '#28a745')}} !important;
            border: none;
        }
        [class*="danger"], [class*="danger"]:hover {
            color:{{\App\Setting::val('cor-perigo-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-perigo', '#dc3545')}} !important;
            border: none;
        }
        [class*="warning"], [class*="warning"]:hover {
            color:{{\App\Setting::val('cor-alerta-texto', '#343a40')}} !important;
            background-color: {{\App\Setting::val('cor-alerta', '#ffc107')}} !important;
            border: none;
        }
        [class*="info"], [class*="info"]:hover {
            color:{{\App\Setting::val('cor-info-texto', '#fff')}} !important;
            background-color: {{\App\Setting::val('cor-info', '#17a2b8')}} !important;
            border: none;
        }
        [class*="primary"]:hover,
        [class*="secondary"]:hover,
        [class*="success"]:hover,
        [class*="danger"]:hover,
        [class*="warning"]:hover,
        [class*="info"]:hover {
            filter: brightness(0.9);
        }
    </style>
    @yield('template_linked_css')
    @yield('stylesheets')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!} ;
    </script>
@stop

@section('js')
    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        function loading_show(){
            $('#loading').show();
        }
        function loading_hide(){
            $('#loading').hide();
        }
        $(function(){
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
            loading_hide();
        });
    </script>
    @include('laravelusers::scripts.toggleText')
    @yield('template_scripts')
    @yield('scripts')
    <script>
        $(function(){
            $('input[name=_method][value=DELETE]').each(function(index, button){
                $(button).closest('form').on("submit", function(){
                    return confirm("{{__('app.confirm_delete')}}");
                });
            });
        })
    </script>
@stop
@if (false)
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


</head>
<body>
    <div id="wrapper" class="d-flex">
        @include('layouts._navbar')
        @if (!Auth::guest())
            @include('layouts._sidebar')
        @endif
        @yield('content')
    </div>
</body>
</html>
@endif