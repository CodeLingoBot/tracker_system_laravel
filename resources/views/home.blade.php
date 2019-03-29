@extends('layouts.app')
@section('title', __('app.dashboard'))
@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('app.dashboard') }}
    </span>
</div>
@stop
@section('content')
<div class="col-md-8 col-md-offset-2">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!
</div>
@endsection
