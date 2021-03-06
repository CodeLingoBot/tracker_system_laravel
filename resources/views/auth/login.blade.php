@extends('layouts.app')

@section('title', __('auth.login.title'))

@section('layout-content')
    <h1 style="text-align: center;">{{__('auth.login.title')}}</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <img src="{{\App\Setting::val('logotipo', '/img/no-image.png')}}"
                     style="width: 100%;margin-top: 27px; margin-bottom: 10px;"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <form  method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">{{ __('auth.login.email') }}</label>
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">{{ __('auth.login.password') }}</label>

                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('auth.login.remember_me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            {{ __('auth.login.login') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('auth.login.forgot_password') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
