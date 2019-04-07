@extends('layouts.app')
@section('title', __('contact_types.'.($contactType->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('contact_types.'.($contactType->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('contact_types.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form  method="POST"
          action="{{ $contactType->id ? route('contact_types.update', $contactType) : route('contact_types.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($contactType->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $contactType->name) }}"
                   required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('mask') ? ' has-error' : '' }}">
            <label for="mask" class="control-label">{!! __('contact_types.mask') !!}</label>
            <input id="mask" type="text" class="form-control" name="mask" value="{{ old('mask', $contactType->mask) }}"
                   required autofocus>

            @if ($errors->has('mask'))
                <span class="help-block">
                    <strong>{{ $errors->first('mask') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection
