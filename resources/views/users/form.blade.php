@extends('layouts.app')
@php($user = empty($user) ? new App\User() : $user)
@section('title', __('users.'.($user->id?'edit':'new').'_title'). ($user->id?' ['.$user->name.']':''))
@section('content_header')
<div class="my-content-header">
    <span>
     {{ __('users.'.($user->id?'edit':'new').'_title') }} {{ ($user->id?'['.$user->name.']':'') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.back', [
            'url' => route('users')
            ])
        @if ($user->id)
            @include('layouts.partials.buttons.back', [
                'url' => route('users.show', $user),
                'text' => __('users.back_to_user')
                ])
        @endif
    </div>
</div>
@stop
@section('layout-content')
<form action="{{ ($user->id?route('users.update', $user):route('users.store')) }}" method="POST">
    @if ($user->id) @method('PUT') @endif
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">{{ __('app.email') }}</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required >

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required >

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if (\Auth::user()->isAdmin())
        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
            <label for="role" class="control-label">{{ __('users.role') }}</label>
            <select id="role" type="text" class="form-control" name="role" value="{{ old('role') }}" required>
                @foreach ($roles as $role)
                    <option {!! $user->hasRole($role->slug) ? 'selected="true"':"" !!} value="{{$role->id}}">{{$role->name}}</option>
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
    <div class="row">
        <div class="col-md-6 form-group{{ $errors->has('is_company') ? ' has-error' : '' }}">
            <label for="is_company" class="control-label">{{ __('users.is_company') }}</label>
            <select id="is_company" type="text" class="form-control" name="is_company" value="{{ old('is_company', $user->is_company) }}" required onchange="setMask(this.value);">
                <option {!! $user->is_company ? "selected='true'":"" !!}value="true">{{ __('users.is_company_yes') }}</option>
                <option {!! !$user->is_company ? "selected='true'":"" !!}value="false">{{ __('users.is_company_no') }}</option>
            </select>
            @if ($errors->has('is_company'))
                <span class="help-block">
                    <strong>{{ $errors->first('is_company') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6 form-group{{ $errors->has('cpf_cnpj') ? ' has-error' : '' }}">
            <label for="cpf_cnpj" class="control-label">{{ __('users.cpf_cnpj') }}</label>
            <input id="cpf_cnpj" type="text" class="form-control" name="cpf_cnpj" value="{{ old('cpf_cnpj', $user->cpf_cnpj) }}" required/>
            @if ($errors->has('cpf_cnpj'))
                <span class="help-block">
                    <strong>{{ $errors->first('cpf_cnpj') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
            <label for="zip_code" class="control-label">{{ __('users.zip_code') }}</label>
            <input id="zip_code" type="text" class="form-control" name="zip_code"
                   value="{{ old('zip_code', $user->zip_code) }}" required >

            @if ($errors->has('zip_code'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                </span>
            @endif
        </div>
         <div class="col-md-4 form-group">
            <label class="control-label">{{ __('users.state') }}</label>
            <select id="contry" type="text" style="display: none;" required>
            </select>
            <select id="state" type="text" class="form-control" required>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label class="control-label">{{ __('users.city_id') }}</label>
            <select id="city_id" name="city_id" type="text" class="form-control" required>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group{{ $errors->has('neighborhood') ? ' has-error' : '' }}">
            <label for="neighborhood" class="control-label">{{ __('users.neighborhood') }}</label>
            <input id="neighborhood" type="text" class="form-control" name="neighborhood" value="{{ old('neighborhood', $user->neighborhood) }}" required >

            @if ($errors->has('neighborhood'))
                <span class="help-block">
                    <strong>{{ $errors->first('neighborhood') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address" class="control-label">{{ __('users.address') }}</label>
            <input id="address" type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" required >

            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group{{ $errors->has('accession') ? ' has-error' : '' }}">
            <label for="accession" class="control-label">{{ __('users.accession') }}</label>
            <input id="accession" type="text" class="form-control" name="accession" value="{{ old('accession', $user->accession) }}" required/>
            @if ($errors->has('accession'))
                <span class="help-block">
                    <strong>{{ $errors->first('accession') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-4 form-group{{ $errors->has('payment_day') ? ' has-error' : '' }}">
            <label for="payment_day" class="control-label">{{ __('users.payment_day') }}</label>
            <input id="payment_day" type="number" class="form-control" name="payment_day" value="{{ old('payment_day', $user->payment_day) }}" required min=1 max=31/>
            @if ($errors->has('payment_day'))
                <span class="help-block">
                    <strong>{{ $errors->first('payment_day') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-4 form-group{{ $errors->has('payment_monthy') ? ' has-error' : '' }}">
            <label for="payment_monthy" class="control-label">{{ __('users.payment_monthy') }}</label>
            <input id="payment_monthy" type="text" class="form-control" name="payment_monthy" value="{{ old('payment_monthy', $user->payment_monthy) }}" required/>
            @if ($errors->has('payment_monthy'))
                <span class="help-block">
                    <strong>{{ $errors->first('payment_monthy') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 form-group{{ $errors->has('validation') ? ' has-error' : '' }}">
            <label for="validation" class="control-label">{{ __('users.validation') }}</label>
            <input id="validation" type="text" class="form-control" name="validation" value="{{ old('validation', $user->validation ? \Helper::formatDate($user->validation) : date_format(date_create("+100 years"), 'd/m/Y H:i')) }}" >

            @if ($errors->has('validation'))
                <span class="help-block">
                <strong>{{ $errors->first('validation') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">{{ __('users.password') }}</label>
            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" @if(!$user->id) required @endif autocomplete="none">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password_confirmation" class="control-label">{{ __('users.password_confirmation') }}</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" @if(!$user->id) required @endif >

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </div>
</form>
@endsection

@section('scripts')
    <script>
        function setMask(value){
            $("#cpf_cnpj").mask(eval(value) ? "99.999.999/9999-99" : "999.999.999-99").change();
        }
        $(document).ready(function ($) {
            $("#zip_code").mask("99999-999").change();
            const unit = '{{ App\Setting::val('tipo-moeda', 'R$') }}';
            $("#accession").maskMoney(unit);
            $("#payment_monthy").maskMoney(unit);
            $("#validation").mask("99/99/9999 99:99");
            $.postmon.loading.init = function(){loading_show();};
            $.postmon.loading.end = function(){loading_hide();};
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
                selected: {
                    pais: 0,
                    estado: {!! isset($user->city_id) ? $user->city->state_id : "null" !!},
                    cidade: {!! isset($user->city_id) ? $user->city_id : "null" !!},
                }
            });
            setMask({!! $user->is_company !!});
            $('#validation').datetimepicker({
                format: 'dd/mm/yyyy hh:ii',
            });
            setTimeout(function () {
                $("#password").val('');
            }, 1000);
        });
    </script>
@endsection

