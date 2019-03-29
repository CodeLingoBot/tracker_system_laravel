@extends('layouts.app')
@section('title', __('vehicles.'.($vehicle->id?'edit':'new').'_title'))
@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('vehicles.'.($vehicle->id?'edit':'new').'_title') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.back', ['url'=>route('vehicles.index')])
    </div>
</div>
@stop
@section('content')
<form class="" method="POST" action="{{ $vehicle->id ? route('vehicles.update', $vehicle) : route('vehicles.store') }}" style="width: 100%;">
    {{ csrf_field() }}
    @if($vehicle->id) @method("PUT") @endif

    <div class="form-group{{ $errors->has('driver_id') ? ' has-error' : '' }}">
        <label for="driver_id" class="control-label">{{ __('vehicles.driver') }}</label>
        <select id="driver_id" type="text" class="form-control" name="driver_id" name="{{ old('type', $vehicle->type) }}" required autofocus>
            @foreach($drivers as $driver)
                <option
                    value="{{ $driver->id }}"
                    {!! $driver->id == $vehicle->driver_id ? 'selected="true"' : '' !!}
                    >
                    {{ $driver->name }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('driver_id'))
            <span class="help-block">
                <strong>{{ $errors->first('driver_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label">{{ __('app.name') }}</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $vehicle->name) }}" required>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('uuid') ? ' has-error' : '' }}">
        <label for="uuid" class="control-label">{{ __('vehicles.uuid') }}</label>
        <input id="uuid" type="text" class="form-control" name="uuid" value="{{ old('uuid', $vehicle->uuid) }}" required>

        @if ($errors->has('uuid'))
            <span class="help-block">
                <strong>{{ $errors->first('uuid') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group text-right">
        @include('layouts.partials.buttons.save')
    </div>
</form>
@endsection