@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('/css/vendor/file-manager.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('file-manager.title')}}</div>

                    <div class="card-body" style="min-height: 600px;">
                        <div id="fm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/vendor/file-manager.js') }}"></script>
@endsection
