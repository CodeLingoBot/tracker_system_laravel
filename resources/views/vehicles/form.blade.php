@extends('layouts.app')
@section('title', __('vehicles.'.($vehicle->id?'edit':'new').'_title'))
@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('vehicles.'.($vehicle->id?'edit':'new').'_title') }} {{ $finalUserId ? __('app.to') . " " . App\User::find($finalUserId)->name : "" }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('vehicles.index', ['final_user_id'=>$finalUserId])])
        </div>
    </div>
@stop
@section('layout-content')
    <form  method="POST"
          action="{{ $vehicle->id ? route('vehicles.update', $vehicle) : route('vehicles.store', ['final_user_id'=>$finalUserId]) }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($vehicle->id) @method("PUT") @endif
        @if(!$final)
            @if (!$finalUserId)
                <div class="row">
                    <div class="col-md-12 form-group{{ $errors->has('tracker_id') ? ' has-error' : '' }}">
                        <label for="final_user_id" class="control-label">{{ __('vehicles.final_user') }}</label>
                        <select id="final_user_id" type="text" class="form-control" name="final_user_id"
                                name="{{ old('type', $vehicle->final_user_id) }}" required autofocus>
                            @foreach($finals as $finalUser)
                                <option
                                        value="{{ $finalUser->id }}"
                                        {!! $finalUser->id ==  $vehicle->final_user_id ? 'selected="true"' : '' !!}
                                >
                                    {{ $finalUser->name }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('final_user_id'))
                            <span class="help-block">
                        <strong>{{ $errors->first('final_user_id') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            @else
                <input type="hidden" value="{{ $finalUserId }}" name="final_user_id">
            @endif

            <div class="row">
                <div class="col-md-6 form-group{{ $errors->has('driver_id') ? ' has-error' : '' }}">
                    <label for="driver_id" class="control-label">{{ __('vehicles.driver') }}</label>
                    <select id="driver_id" type="text" class="form-control" name="driver_id"
                            name="{{ old('type', $vehicle->type) }}" required autofocus>
                        @foreach($drivers as $driver)
                            <option
                                    value="{{ $driver->id }}"
                                    {!! $driver->id == $vehicle->driver_id ? 'selected="true"' : '' !!}
                            >
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('driver_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('driver_id') }}</strong>
                </span>
                    @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">{{ __('app.name') }}</label>
                    <input id="name" type="text" class="form-control" name="name"
                           value="{{ old('name', $vehicle->name) }}"
                           required>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group{{ $errors->has('uuid') ? ' has-error' : '' }}">
                    <label for="uuid" class="control-label">{{ __('vehicles.uuid') }}</label>
                    <input id="uuid" type="text" class="form-control" name="uuid"
                           value="{{ old('uuid', $vehicle->uuid) }}"
                           required>

                    @if ($errors->has('uuid'))
                        <span class="help-block">
                    <strong>{{ $errors->first('uuid') }}</strong>
                </span>
                    @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('board') ? ' has-error' : '' }}">
                    <label for="board" class="control-label">{{ __('vehicles.board') }}</label>
                    <input id="board" type="text" class="form-control" name="board"
                           value="{{ old('board', $vehicle->board) }}"
                           required>

                    @if ($errors->has('board'))
                        <span class="help-block">
                        <strong>{{ $errors->first('board') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="row">

                <div class="col-md-4 form-group{{ $errors->has('fleet_id') ? ' has-error' : '' }}">
                    <label for="fleet_id" class="control-label">{{ __('vehicles.fleet') }}</label>
                    <select id="fleet_id" type="text" class="form-control" name="fleet_id"
                            name="{{ old('type', $vehicle->fleet_id) }}" required autofocus>
                        @foreach($fleets as $fleet)
                            <option
                                    value="{{ $fleet->id }}"
                                    {!! $fleet->id ==  $vehicle->fleet_id ? 'selected="true"' : '' !!}
                            >
                                {{ $fleet->name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('fleet_id'))
                        <span class="help-block">
                        <strong>{{ $errors->first('tracker_id') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="col-md-4 form-group{{ $errors->has('sim_card') ? ' has-error' : '' }}">
                    <label for="sim_card" class="control-label">{{ __('vehicles.sim_card') }}</label>
                    <input id="sim_card" type="text" class="form-control" name="sim_card"
                           value="{{ old('sim_card', $vehicle->sim_card) }}"
                           required>

                    @if ($errors->has('sim_card'))
                        <span class="help-block">
                        <strong>{{ $errors->first('sim_card') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="col-md-4 form-group{{ $errors->has('tracker_id') ? ' has-error' : '' }}">
                    <label for="tracker_id" class="control-label">{{ __('vehicles.tracker') }}</label>
                    <select id="tracker_id" type="text" class="form-control" name="tracker_id"
                            name="{{ old('type', $vehicle->tracker_id) }}" required autofocus>
                        @foreach($trackerTypes as $tracker)
                            <option
                                    value="{{ $tracker->id }}"
                                    {!! $tracker->id ==  $vehicle->tracker_id ? 'selected="true"' : '' !!}
                            >
                                {{ $tracker->name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('tracker_id'))
                        <span class="help-block">
                        <strong>{{ $errors->first('tracker_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4 form-group">
                <label for="type" class="control-label">{{ __('vehicle_branchs.type') }}</label>
                <select id="type" type="text" class="form-control" required autofocus
                        onchange="onChangeType(this.value);">
                    @for($index=0; $index<4; $index++)
                        <option @if ($vehicle->model && $vehicle->model->branch && $vehicle->model->branch->type == $index) selected="true"
                                @endif
                                value="{{$index}}">{{__('vehicle_branchs.type_'.$index)}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="branchs" class="control-label">{{ __('vehicles.branchs') }}</label>
                <select id="branchs" type="text" class="form-control" required autofocus
                        onchange="onChangeBranch(this.value);">
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="model_id" class="control-label">{{ __('vehicles.model') }}</label>
                <select id="model_id" name="model_id" type="text" class="form-control" required autofocus>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group{{ $errors->has('odometer') ? ' has-error' : '' }}">
                <label for="odometer" class="control-label">{{ __('vehicles.odometer') }}</label>
                <input id="odometer" type="text" class="form-control" name="odometer"
                       value="{{ old('odometer', $vehicle->odometer) }}" required min=1 max=31/>
                @if ($errors->has('odometer'))
                    <span class="help-block">
                    <strong>{{ $errors->first('odometer') }}</strong>
                </span>
                @endif
            </div>

            <div class="col-md-4 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                <label for="year" class="control-label">{{ __('vehicles.year') }}</label>
                <input id="year" type="number" class="form-control" name="year"
                       value="{{ old('year', $vehicle->year) }}" required min=1 max=31/>
                @if ($errors->has('year'))
                    <span class="help-block">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
                @endif
            </div>

            @php( $color = ($vehicle->id && $vehicle->color) ? $vehicle->color : "#000" )
            <div class="col-md-4 form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                <label for="color" class="control-label">{{ __('vehicles.color') }}</label>
                <input id="color" type="text" class="form-control" name="color" value="{{ old('color', $color) }}"
                       required min=1 max=31/>
                @if ($errors->has('color'))
                    <span class="help-block">
                    <strong>{{ $errors->first('color') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        const selectedBranch = {{ $vehicle->model && $vehicle->model->branch_id ? $vehicle->model->branch_id : "null"}};
        const selectedModel = {{ $vehicle->model_id ? $vehicle->model_id : "null"}};

        function onChangeType(value) {
            loading_show();
            $.getJSON("/json_branchs/" + value, function (data) {
                const branch = $("#branchs");
                branch.children().remove();
                let yeapSelected = false;
                $.each(data, function (index, item) {
                    if (item.id === selectedBranch) yeapSelected = true;
                    branch.append("<option " + (item.id == selectedBranch ? "selected='true'" : "") + " value='" + item.id + "'>" + item.name + "</option>");
                });
                if (data[0]) branch.val(yeapSelected ? selectedBranch : data[0].id).change();
                loading_hide();
            });
        }

        function onChangeBranch(value) {
            loading_show();
            $.getJSON("/json_models/" + value, function (data) {
                const model = $("#model_id");
                model.children().remove();
                let yeapSelected = false;
                $.each(data, function (index, item) {
                    if (item.id === selectedModel) yeapSelected = true;
                    model.append("<option " + (item.id == selectedModel ? "selected='true'" : "") + "value='" + item.id + "'>" + item.name + "</option>");
                });
                if (data[0]) model.val(yeapSelected ? selectedModel : data[0].id).change();
                loading_hide();
            });
        }

        $(document).ready(function ($) {
            $("#odometer").maskFloat().change();
            $('#color').ColorPicker({
                color: '{{$color}}',
                onChange: function (hsb, hex, rgb) {
                    $('#color').val('#' + hex).css('backgroundColor', '#' + hex);
                }
            });
            $("#type").change();
        });
    </script>
@endsection