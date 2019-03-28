@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('fences.create.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/fences/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('fences.create.create_fance') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('fences.create.create_fance') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('fences.store') }}" style="width: 100%;">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">{{ __('fences.create.name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label">
                                    {{ __('fences.create.center_map') }}
                                </label>
                                <input id="center_map" type="text" class="form-control">
                            </div>

                            <input type="hidden" name="polygon" id="polygon" value="<?php echo old('polygon'); ?>"/>

                            <div class="form-group">
                                {!! $map['html'] !!}
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('fences.create.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $map['js'] !!}
    <script>
        let centerInput;
        let searchBox;

        var polygon = null;
        function onPolygonDrawn(event){
            if (polygon) polygon.overlay.setMap(null);
            polygon = event;
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
@endsection
