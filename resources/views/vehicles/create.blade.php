@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('vehicles.create.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/vehicles')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('vehicles.create.back_to_vehicles') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('vehicles.create.back_to_vehicles') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('vehicles.store') }}" style="width: 100%;">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('vehicles.create.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('uuid') ? ' has-error' : '' }}">
                                <label for="uuid" class="control-label">{{ __('vehicles.edit.uuid') }}</label>
                                <input id="uuid" type="text" class="form-control" name="uuid" value="{{ old('uuid') }}" required autofocus>

                                @if ($errors->has('uuid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uuid') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('driver_id') ? ' has-error' : '' }}">
                                <label for="driver_id" class="control-label">{{ __('vehicles.edit.driver_id') }}</label>
                                <select id="driver_id" type="text" class="form-control" name="driver_id" value="{{ old('driver_id') }}" required>
                                    @foreach ($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('driver_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('driver_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('vehicles.create.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
