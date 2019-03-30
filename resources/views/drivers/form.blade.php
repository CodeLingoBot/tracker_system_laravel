@extends('layouts.app')
@section('title',__('drivers.'.($driver->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('drivers.'.($driver->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('drivers.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form class="" method="POST" action="{{ $driver->id ? route('drivers.update', $driver) : route('drivers.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($driver->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('license_id') ? ' has-error' : '' }}">
            <label for="license_id" class="control-label">{{ __('drivers.license') }}</label>
            <select id="license_id" type="text" class="form-control" name="license_id"
                    name="{{ old('type', $driver->type) }}" required autofocus onchange="setMask();">
                @foreach($licenses as $license)
                    <option
                            value="{{ $license->id }}"
                            {!! $license->id == $driver->license_id ? 'selected="true"' : '' !!}
                    >
                        {{ $license->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('license_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('license_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $driver->name) }}"
                   required>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection