@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('states.edit.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/states')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('states.edit.back_to_states') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('states.edit.back_to_states') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('states.update', $state) }}" style="width: 100%;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('states.edit.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $state->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('initials') ? ' has-error' : '' }}">
                                <label for="initials" class="control-label">{{ __('states.edit.initials') }}</label>
                                <input id="initials" type="text" class="form-control" name="initials" value="{{ old('initials', $state->initials) }}" required autofocus>

                                @if ($errors->has('initials'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initials') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('states.edit.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
