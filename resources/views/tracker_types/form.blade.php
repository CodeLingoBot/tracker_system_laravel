@extends('layouts.app')
@section('title',__('tracker_types.'.($trackerType->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('tracker_types.'.($trackerType->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('tracker_types.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form class="" method="POST"
          action="{{ $trackerType->id ? route('tracker_types.update', $trackerType) : route('tracker_types.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($trackerType->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $trackerType->name) }}"
                   required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection
