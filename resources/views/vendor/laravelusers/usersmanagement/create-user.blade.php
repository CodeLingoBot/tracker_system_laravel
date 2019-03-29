@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('template_title')
    {!! trans('laravelusers::laravelusers.create-new-user') !!}
@endsection

@section('template_linked_css')
    @if(config('laravelusers.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.datatablesCssCDN') }}">
    @endif
    @if(config('laravelusers.fontAwesomeEnabled'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.fontAwesomeCdn') }}">
    @endif
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
    <div class="container">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-lg-12">
                    @include('laravelusers::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('laravelusers::laravelusers.create-new-user') !!}
                            <div class="pull-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{!! trans('laravelusers::laravelusers.tooltips.back-users') !!}">
                                    @if(config('laravelusers.fontAwesomeEnabled'))
                                        <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @endif
                                    {!! trans('laravelusers::laravelusers.buttons.back-to-users') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'users.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">{{ __('users.create.email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">{{ __('users.create.name') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($rolesEnabled)
                                @if (\Auth::user()->isAdmin())
                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        <label for="role" class="control-label">{{ __('users.create.role') }}</label>
                                        <select id="role" type="text" class="form-control" name="role" value="{{ old('role') }}" required>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <input type="hidden" value="2" name="role">
                                @endif
                            @endif
                            <div class="row">
                                <div class="col-md-4 form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                    <label for="zip_code" class="control-label">{{ __('users.create.zip_code') }}</label>
                                    <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required autofocus>

                                    @if ($errors->has('zip_code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zip_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="col-md-4 form-group">
                                    <label class="control-label">{{ __('users.create.state') }}</label>
                                    <select id="contry" type="text" style="display: none;" required>
                                    </select>
                                    <select id="state" type="text" class="form-control" required>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">{{ __('users.create.city_id') }}</label>
                                    <select id="city_id" name="city_id" type="text" class="form-control" required>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group{{ $errors->has('neighborhood') ? ' has-error' : '' }}">
                                    <label for="neighborhood" class="control-label">{{ __('users.create.neighborhood') }}</label>
                                    <input id="neighborhood" type="text" class="form-control" name="neighborhood" value="{{ old('neighborhood') }}" required autofocus>

                                    @if ($errors->has('neighborhood'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('neighborhood') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="control-label">{{ __('users.create.address') }}</label>
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">{{ __('users.create.password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password_confirmation" class="control-label">{{ __('users.create.password_confirmation') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required autofocus>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {!! Form::button(trans('laravelusers::forms.create_user_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('template_scripts')
    @if(config('laravelusers.tooltipsEnabled'))
        @include('laravelusers::scripts.tooltips')
    @endif
    <script>
        var waitForPostmon = setInterval(function () {
            if (typeof $ != 'undefined' && typeof $.postmon != 'undefined') {
                window.VMask(document.getElementById("zip_code")).maskPattern("99999-999");
                $.postmon.loading = $('#loading');
                $.postmon.endpoint_method = "GET";
                $.postmon.paises_endpoint = "{{ url('cep_contries') }}";
                $.postmon.estados_endpoint = "{{ url('cep_states') }}";
                $.postmon.cidades_endpoint = "{{ url('cep_cities') }}";
                $.fn.postmon({
                    select: {
                        pais: $("#contry"),
                        estado: $("#state"),
                        cidade: $("#city_id")
                    },
                    input: {
                        cep: $("#zip_code"),
                        endereco: $("#address"),
                        bairro: $("#neighborhood")
                    },
                });
                clearInterval(waitForPostmon);
            }
        }, 10);
    </script>
@endsection
