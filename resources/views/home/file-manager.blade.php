@extends('layouts.app')
@section('title',__('file-manager.title'))

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('/css/vendor/file-manager.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="min-height: 600px;">
                <div id="fm">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/vendor/file-manager.js') }}"></script>
@endsection
