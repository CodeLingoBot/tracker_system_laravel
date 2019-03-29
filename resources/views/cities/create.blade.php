@extends('layouts.app')

@section('content')
    @php($stateId = Input::get('state_id'))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('cities.create.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/cities')}}?state_id={{ $stateId }}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('cities.create.back_to_cities') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('cities.create.back_to_cities') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('cities.store') }}" style="width: 100%;">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('cities.create.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                                <label for="state_id" class="control-label">{{ __('cities.edit.state_id') }}</label>
                                <select id="state_id" type="text" class="form-control" name="state_id" value="{{ old('state_id', ) }}" required>
                                    @foreach ($states as $state)
                                        <option {!! $stateId == $state->id ? "selected='true'" : "" !!} value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('state_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('cities.create.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
