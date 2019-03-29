@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('states.'.($state->id?'edit':'new').'_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.back', ['url'=>route('states.index')])
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ $state->id ? route('states.update', $state) : route('states.store') }}" style="width: 100%;">
                            {{ csrf_field() }}
                            @if($state->id) @method("PUT") @endif

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('app.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $state->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('initials') ? ' has-error' : '' }}">
                                <label for="initials" class="control-label">{{ __('states.initials') }}</label>
                                <input id="initials" type="text" class="form-control" name="initials" value="{{ old('initials', $state->initials) }}" required autofocus>

                                @if ($errors->has('initials'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initials') }}</strong>
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
