@extends('layouts.app')
@section('title', __('tawk.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('tawk.index_title') }}
    </span>
    </div>
@stop
@section('layout-content')
    <div style="height: 500px;">
        <iframe frameborder="0" style="width: 100%; height: 100%;" src="{{ url('/tawk-frame') }}"></iframe>
    </div>
@endsection