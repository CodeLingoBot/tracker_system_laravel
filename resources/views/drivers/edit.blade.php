@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('drivers.edit.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/drivers')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('drivers.edit.back_to_drivers') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('drivers.edit.back_to_drivers') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('drivers.update', $driver) }}" style="width: 100%;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('drivers.edit.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $driver->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('license_id') ? ' has-error' : '' }}">
                                <label for="license_id" class="control-label">{{ __('drivers.edit.license_id') }}</label>
                                <select id="license_id" type="text" class="form-control" name="license_id" value="{{ old('license_id', $driver->license_id) }}" required>
                                    @foreach ($licenses as $license)
                                        <option value="{{$license->id}}" {{($license->id==$driver->license_id)?"selected=true":""}}>{{$license->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('license_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('drivers.edit.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
