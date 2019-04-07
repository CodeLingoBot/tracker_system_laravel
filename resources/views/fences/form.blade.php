@extends('layouts.app')
@section('title',__('fences.'.($fence->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('fences.'.($fence->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('fences.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form  method="POST" action="{{ $fence->id?route('fences.update', $fence):route('fences.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($fence->id) @method("PUT") @endif
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $fence->name) }}"
                   required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="name" class="control-label">
                {{ __('fences.center_map') }}
            </label>
            <input id="center_map" type="text" class="form-control">
        </div>
        <?php $polygon = old('plygon', str_replace("\"", "'", $fence->polygon));?>
        <input type="hidden" name="polygon" id="polygon" value="<?php echo $polygon; ?>"/>

        <div class="form-group">
            {!! $map['html'] !!}
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        let centerInput;
        let searchBox;

        var polygon = null;

        function onPolygonDrawn(event) {
            if (polygon) {
                try {
                    polygon.setMap(null);
                } catch (e) {
                }
            }
            polygon = event.overlay;
            const data = {
                positions: []
            }
            event.overlay.getPath().getArray().forEach(function (position) {
                data.positions.push({
                    lat: position.lat(),
                    lng: position.lng()
                });
            });
            document.getElementById('polygon').value = JSON.stringify(data);
        }
    </script>
    {!! $map['js'] !!}
@endsection
