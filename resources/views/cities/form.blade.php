@extends('layouts.app')
@section('title', __('cities.'.($city->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('cities.'.($city->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('cities.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form  method="POST" action="{{ $city->id?route('cities.update', $city):route('cities.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($city->id) @method('PUT') @endif

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $city->name) }}"
                   required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
            <label for="state_id" class="control-label">{{ __('cities.state') }}</label>
            <select id="state_id" type="text" class="form-control" name="state_id"
                    value="{{ old('state_id', $city->state_id) }}" required>
                @foreach ($states as $state)
                    <option value="{{$state->id}}" {{($state->id==$city->state_id)?"selected=true":""}}>{{$state->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('state_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('state_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection
