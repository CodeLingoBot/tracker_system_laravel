@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('roles.edit.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/roles')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('roles.edit.back_to_roles') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('roles.edit.back_to_roles') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('roles.update', $role) }}" style="width: 100%;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('roles.edit.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="control-label">{{ __('roles.edit.slug') }}</label>
                                <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug', $role->slug) }}" required autofocus>

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="control-label">{{ __('roles.edit.description') }}</label>
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description', $role->description) }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="control-label">{{ __('roles.edit.level') }}</label>
                                <input id="level" type="number" class="form-control" name="level" value="{{ old('level', $role->level) }}" required autofocus>

                                @if ($errors->has('level'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('roles.edit.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
