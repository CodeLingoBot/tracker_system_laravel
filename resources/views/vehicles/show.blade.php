@extends('layouts.app')
@section('title', __('vehicles.show_title'))
@section('content_header')
    <div class="my-content-header">
        <span>
            {{ __('vehicles.show_title') }}
        </span>
    </div>
@stop
@section('layout-content')
    @if(isset($map))
        {!! $map['html'] !!}
        {!! $map['js'] !!}
    @endif
@endsection