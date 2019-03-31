@extends('layouts.app')
@section('title',__('vehicle_models.'.($vehicleModel->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('vehicle_models.'.($vehicleModel->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('vehicle_models.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form class="" method="POST" action="{{ $vehicleModel->id ? route('vehicle_models.update', $vehicleModel) : route('vehicle_models.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($vehicleModel->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
            <label for="branch_id" class="control-label">{{ __('vehicle_models.branch') }}</label>
            <select id="branch_id" type="text" class="form-control" name="branch_id"
                    name="{{ old('type', $vehicleModel->type) }}" required autofocus onchange="setMask();">
                @foreach($vehicleBranchs as $vehicleBranch)
                    <option
                            value="{{ $vehicleBranch->id }}"
                            {!! $vehicleBranch->id == $vehicleModel->branch_id ? 'selected="true"' : '' !!}
                    >
                        {{ $vehicleBranch->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('branch_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('branch_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $vehicleModel->name) }}"
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