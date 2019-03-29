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
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">{{ __('users.create.name') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

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
                                <div class="col-md-6 form-group{{ $errors->has('is_company') ? ' has-error' : '' }}">
                                    <label for="is_company" class="control-label">{{ __('users.create.is_company') }}</label>
                                    <select id="is_company" type="text" class="form-control" name="is_company" value="{{ old('is_company') }}" required onchange="setMask(this.value);">
                                        <option value="true">{{ __('users.create.is_company_yes') }}</option>
                                        <option value="false">{{ __('users.create.is_company_no') }}</option>
                                    </select>
                                    @if ($errors->has('is_company'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('is_company') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('cpf_cnpj') ? ' has-error' : '' }}">
                                    <label for="cpf_cnpj" class="control-label">{{ __('users.create.cpf_cnpj') }}</label>
                                    <input id="cpf_cnpj" type="text" class="form-control" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}" required/>
                                    @if ($errors->has('cpf_cnpj'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cpf_cnpj') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                    <label for="zip_code" class="control-label">{{ __('users.create.zip_code') }}</label>
                                    <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required>

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
                                    <input id="neighborhood" type="text" class="form-control" name="neighborhood" value="{{ old('neighborhood') }}" required>

                                    @if ($errors->has('neighborhood'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('neighborhood') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="control-label">{{ __('users.create.address') }}</label>
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group{{ $errors->has('accession') ? ' has-error' : '' }}">
                                    <label for="accession" class="control-label">{{ __('users.create.accession') }}</label>
                                    <input id="accession" type="text" class="form-control" name="accession" value="{{ old('accession') }}" required/>
                                    @if ($errors->has('accession'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('accession') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('payment_day') ? ' has-error' : '' }}">
                                    <label for="payment_day" class="control-label">{{ __('users.create.payment_day') }}</label>
                                    <input id="payment_day" type="number" class="form-control" name="payment_day" value="{{ old('payment_day') }}" required min=1 max=31/>
                                    @if ($errors->has('payment_day'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('payment_day') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('payment_monthy') ? ' has-error' : '' }}">
                                    <label for="payment_monthy" class="control-label">{{ __('users.create.payment_monthy') }}</label>
                                    <input id="payment_monthy" type="text" class="form-control" name="payment_monthy" value="{{ old('payment_monthy') }}" required/>
                                    @if ($errors->has('payment_monthy'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('payment_monthy') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">{{ __('users.create.password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autocomplete="none">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password_confirmation" class="control-label">{{ __('users.create.password_confirmation') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>

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
        function setMask(value){
            const cpfCnpj = window.VMask(document.getElementById("cpf_cnpj"));
            cpfCnpj.maskPattern(eval(value) ? "99.999.999/9999-99" : "999.999.999-99");
        }

        var waitForPostmon = setInterval(function () {
            if (typeof $ != 'undefined' && typeof $.postmon != 'undefined' && typeof window.VMask != 'undefined') {
                window.VMask(document.getElementById("zip_code")).maskPattern("99999-999");
                const maskMoney = {
                  precision: 2,
                  separator: ',',
                  delimiter: '.',
                  unit: "{{ App\Setting::val('tipo-moeda', 'R$') }}",
                  zeroCents: true
                };
                window.VMask(document.getElementById("accession")).maskMoney(maskMoney);
                window.VMask(document.getElementById("payment_monthy")).maskMoney(maskMoney);
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
                setMask(true);
                clearInterval(waitForPostmon);
                setTimeout(function(){
                    $("#password").val('');
                }, 1000);
            }
        }, 10);
    </script>
@endsection
