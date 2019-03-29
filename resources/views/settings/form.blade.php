@extends('layouts.app')
@section('title', __('settings.'.($setting->id?'edit':'new').'_title'))

@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('settings.'.($setting->id?'edit':'new').'_title') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.back', ['url'=>route('settings.index')])
    </div>
</div>
@stop
@section('content')
<form class="" method="POST" action="{{ $setting->id ? route('settings.update', $setting) : route('settings.store') }}" style="width: 100%;">
    {{ csrf_field() }}
    @if($setting->id) @method("PUT") @endif

    <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
        <label for="key" class="control-label">{{ __('settings.key') }}</label>
        <input id="key" type="text" class="form-control" name="key" value="{{ old('key', $setting->key) }}" required autofocus>

        @if ($errors->has('key'))
            <span class="help-block">
                <strong>{{ $errors->first('key') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
        <label for="value" class="control-label">{{ __('settings.value') }}</label>
        <input id="value" type="text" class="form-control" name="value" value="{{ old('value', $setting->value) }}" required autofocus>

        @if ($errors->has('value'))
            <span class="help-block">
                <strong>{{ $errors->first('value') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group text-right">
        @include('layouts.partials.buttons.save')
    </div>
</form>
@endsection
