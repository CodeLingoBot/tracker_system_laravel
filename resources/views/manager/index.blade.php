@extends('layouts.app')
@section('title', __('app.dashboard'))
@section('content_header')
    <div class="content-header">
    <span>
        {{ __('app.dashboard') }}
    </span>
    </div>
@stop
@section('layout-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 manager">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (Auth::user()->isAdmin())
                    <a href="{{ url('/roles') }}">
                        <i class="fas fa-user-tag"></i>
                        {{__('layouts.app.sidebar.roles')}}
                    </a>
                    <a href="{{ url('/users') }}">
                        <i class="fas fa-users"></i>
                        {{__('layouts.app.sidebar.users')}}
                    </a>
                    <a href="{{ url('/file-manager') }}">
                        <i class="fas fa-file"></i>
                        {{__('layouts.app.sidebar.file-manager')}}
                    </a>
                    <a href="{{ url('/tawk') }}">
                        <i class="fas fa-comments"></i>
                        {{__('layouts.app.sidebar.tawk')}}
                    </a>
                    <a href="{{ url('/settings') }}">
                        <i class="fas fa-cogs"></i>
                        {{__('layouts.app.sidebar.settings')}}
                    </a>
                    <a href="{{ url('/licenses') }}">
                        <i class="fas fa-id-badge"></i>
                        {{__('layouts.app.sidebar.licenses')}}
                    </a>
                    <a href="{{ url('/contact_types') }}">
                        <i class="fas fa-object-ungroup"></i>
                        {{__('layouts.app.sidebar.contact_types')}}
                    </a>
                    <a href="{{ url('states') }}">
                        <i class="fas fa-flag"></i>
                        {{__('layouts.app.sidebar.states')}}
                    </a>
                    <a href="{{ url('tracker_types') }}">
                        <i class="fas fa-flag"></i>
                        {{__('layouts.app.sidebar.tracker_types')}}
                    </a>
                    <a href="{{ url('vehicle_branchs') }}">
                        <i class="fas fa-flag"></i>
                        {{__('layouts.app.sidebar.vehicle_branchs')}}
                    </a>
                    <a href="{{ url('vehicle_models') }}">
                        <i class="fas fa-flag"></i>
                        {{__('layouts.app.sidebar.vehicle_models')}}
                    </a>
                    <h2>
                        <strong>{{__('layouts.app.sidebar.subadmin')}}</strong>
                    </h2>
                @endif
                @if (Auth::user()->isAdmin() || Auth::user()->isSubAdmin())
                    <a href="{{ url('/users') }}">
                        <i class="fas fa-users "></i>
                        {{__('layouts.app.sidebar.users')}}
                    </a>
                    <a href="{{ url('/drivers') }}">
                        <i class="fas fa-user-circle"></i>
                        {{__('layouts.app.sidebar.drivers')}}
                    </a>
                    <a href="{{ url('/fleets') }}">
                        <i class="fas fa-truck"></i>
                        {{__('layouts.app.sidebar.fleets')}}
                    </a>
                    <a href="{{ url('/vehicles') }}">
                        <i class="fas fa-car"></i>
                        {{__('layouts.app.sidebar.vehicles')}}
                    </a>
                    <a href="{{ url('/fences') }}">
                        <i class="fas fa-map"></i>
                        {{__('layouts.app.sidebar.fences')}}
                    </a>
                    <h2>
                        <strong>{{__('layouts.app.sidebar.final_user')}}</strong>
                    </h2>
                @endif
                <a href="{{ url('/vehicles') }}">
                    <i class="fas fa-car"></i>
                    {{__('layouts.app.sidebar.vehicles')}}
                </a>
                <a href="{{ url('/fences') }}">
                    <i class="fas fa-map"></i>
                    {{__('layouts.app.sidebar.fences')}}
                </a>
            </div>
        </div>
    </div>
@endsection