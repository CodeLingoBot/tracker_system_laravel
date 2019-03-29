@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('contacts.edit.title') }} [{{ $user->name }}]
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/contacts')}}?user_id={{ $user->id }}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('contacts.edit.back_to_contacts') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('contacts.edit.back_to_contacts') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('contacts.update', $contact) }}?user_id={{ $user->id }}" style="width: 100%;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label for="type_id" class="control-label">{{ __('contacts.edit.type_id') }}</label>
                                <select id="type_id" type="text" class="form-control" name="type_id" value="{{ old('type_id', $contact->type_id) }}" required>
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}" {{($type->id==$contact->type_id)?"selected=true":""}}>{{$type->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('type_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="value" class="control-label">{{ __('contacts.edit.value') }}</label>
                                <input id="value" type="text" class="form-control" name="value" value="{{ old('value', $contact->value) }}" required autofocus>

                                @if ($errors->has('value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('contacts.edit.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
