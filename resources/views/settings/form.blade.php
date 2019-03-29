@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('settings.'.($setting->id?'edit':'new').'_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.back', ['url'=>route('settings.index')])
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ $setting->id ? route('settings.update', $setting) : route('settings.store') }}" style="width: 100%;">
                            {{ csrf_field() }}
                            @if($setting->id) @method("PUT") @endif

                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                <label for="key" class="control-label">{{ __('settings.key') }}</label>
                                <input id="key" type="text" class="form-control" name="key" value="{{ old('key', $setting->key) }}" required autofocus>

                                @if ($errors->has('key'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="value" class="control-label">{{ __('settings.value') }}</label>
                                <input id="value" type="text" class="form-control" name="value" value="{{ old('value', $setting->value) }}" required autofocus>

                                @if ($errors->has('value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                @include('layouts.partials.buttons.save')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
