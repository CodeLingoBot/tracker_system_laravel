@extends('layouts.app')

@section('title', __('auth.email.title'))

@section('layout-content')
    <h1 style="text-align: center;">{{__('auth.email.title')}}</h1>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <img src="{{\App\Setting::val('logotipo', '/img/no-image.png')}}"
                     style="width: 100%;margin-top: 27px;"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <form  method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"
                         style="margin-top: 5rem;">
                        <label for="email" class="control-label">{{__('auth.email.email')}}</label>
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            {{__('auth.email.send')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
