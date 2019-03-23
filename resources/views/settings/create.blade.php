@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('settings.create.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/settings')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('settings.create.back_to_settings') }}"
                                   class="btn btn-default btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('settings.create.back_to_settings') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}" style="width: 100%;">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                <label for="key" class="control-label">{{ __('settings.create.key') }}</label>
                                <input id="key" type="text" class="form-control" name="key" value="{{ old('key') }}" required autofocus>

                                @if ($errors->has('key'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="value" class="control-label">{{ __('settings.create.value') }}</label>
                                <input id="value" type="text" class="form-control" name="value" value="{{ old('value') }}" required autofocus>

                                @if ($errors->has('value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('settings.create.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
