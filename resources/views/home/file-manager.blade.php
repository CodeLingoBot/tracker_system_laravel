@extends('layouts.app')
@section('title', __('file-manager.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('file-manager.index_title') }}
    </span>
    </div>
@stop
@section('layout-content')
    <div style="height: 500px;">
        <iframe frameborder="0" style="width: 100%; height: 100%;" src="{{ url('/file-manager-frame') }}"></iframe>
    </div>
@endsection