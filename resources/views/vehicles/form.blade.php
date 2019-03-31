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
@section('layout-content')
    <form class="" method="POST"
          action="{{ $vehicle->id ? route('vehicles.update', $vehicle) : route('vehicles.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($vehicle->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('driver_id') ? ' has-error' : '' }}">
            <label for="driver_id" class="control-label">{{ __('vehicles.driver') }}</label>
            <select id="driver_id" type="text" class="form-control" name="driver_id"
                    name="{{ old('type', $vehicle->type) }}" required autofocus>
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
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $vehicle->name) }}"
                   required>

            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('uuid') ? ' has-error' : '' }}">
            <label for="uuid" class="control-label">{{ __('vehicles.uuid') }}</label>
            <input id="uuid" type="text" class="form-control" name="uuid" value="{{ old('uuid', $vehicle->uuid) }}"
                   required>

            @if ($errors->has('uuid'))
                <span class="help-block">
                <strong>{{ $errors->first('uuid') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('board') ? ' has-error' : '' }}">
            <label for="board" class="control-label">{{ __('vehicles.board') }}</label>
            <input id="board" type="text" class="form-control" name="board" value="{{ old('board', $vehicle->board) }}"
                   required>

            @if ($errors->has('board'))
                <span class="help-block">
                <strong>{{ $errors->first('board') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('sim_card') ? ' has-error' : '' }}">
            <label for="sim_card" class="control-label">{{ __('vehicles.sim_card') }}</label>
            <input id="sim_card" type="text" class="form-control" name="sim_card" value="{{ old('sim_card', $vehicle->sim_card) }}"
                   required>

            @if ($errors->has('sim_card'))
                <span class="help-block">
                <strong>{{ $errors->first('sim_card') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('tracker_id') ? ' has-error' : '' }}">
            <label for="tracker_id" class="control-label">{{ __('vehicles.tracker') }}</label>
            <select id="tracker_id" type="text" class="form-control" name="tracker_id"
                    name="{{ old('type', $vehicle->tracker_id) }}" required autofocus>
                @foreach($trackers as $tracker)
                    <option
                            value="{{ $tracker->id }}"
                            {!! $tracker->id ==  $vehicle->tracker_id ? 'selected="true"' : '' !!}
                    >
                        {{ $tracker->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('tracker_id'))
                <span class="help-block">
                <strong>{{ $errors->first('tracker_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('tracker_id') ? ' has-error' : '' }}">
            <label for="final_user_id" class="control-label">{{ __('vehicles.final_user') }}</label>
            <select id="final_user_id" type="text" class="form-control" name="final_user_id"
                    name="{{ old('type', $vehicle->final_user_id) }}" required autofocus>
                @foreach($finalUsers as $finalUser)
                    <option
                            value="{{ $finalUser->id }}"
                            {!! $finalUser->id ==  $vehicle->final_user_id ? 'selected="true"' : '' !!}
                    >
                        {{ $finalUser->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('final_user_id'))
                <span class="help-block">
                <strong>{{ $errors->first('final_user_id') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="type" class="control-label">{{ __('vehicle_branchs.type') }}</label>
            <select id="type" type="text" class="form-control" required autofocus>
                @for($index=0; $index<4; $index++)
                    <option @if ($vehicle->model->branch->type == $index) selected="true" @endif
                    value="{{$index}}">{{__('vehicle_branchs.type_'.$index)}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="branchs" class="control-label">{{ __('drivers.branchs') }}</label>
            <select id="branchs" type="text" class="form-control" required autofocus>
            </select>
        </div>

        <div class="form-group">
            <label for="model_id" class="control-label">{{ __('drivers.model') }}</label>
            <select id="model_id" type="text" class="form-control" required autofocus>
            </select>
        </div>
        $table->float('odometer')->nullable();
        $table->integer('year')->nullable();
        $table->string('color')->nullable();

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection

@section('scripts')

@endsection