@extends('layouts.app')
@section('title',__('vehicle_branchs.'.($vehicleBranch->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('vehicle_branchs.'.($vehicleBranch->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('vehicle_branchs.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form class="" method="POST"
          action="{{ $vehicleBranch->id ? route('vehicle_branchs.update', $vehicleBranch) : route('vehicle_branchs.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($vehicleBranch->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="control-label">{{ __('vehicle_branchs.type') }}</label>
            <select id="type" type="text" class="form-control" name="type" required autofocus>
                @for($index=0; $index<4; $index++)
                    <option @if ($vehicleBranch->type == $index) selected="true" @endif
                            value="{{$index}}">{{__('vehicle_branchs.type_'.$index)}}</option>
                @endfor
            </select>

            @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $vehicleBranch->name) }}"
                   required autofocus>

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
