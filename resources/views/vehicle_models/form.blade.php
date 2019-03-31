@extends('layouts.app')
@section('title',__('vehicle_models.'.($vehicleModel->id?'edit':'new').'_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('vehicle_models.'.($vehicleModel->id?'edit':'new').'_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('vehicle_models.index')])
        </div>
    </div>
@stop
@section('layout-content')
    <form class="" method="POST" action="{{ $vehicleModel->id ? route('vehicle_models.update', $vehicleModel) : route('vehicle_models.store') }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($vehicleModel->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="control-label">{{ __('vehicle_branchs.type') }}</label>
            <select id="type" class="form-control" required autofocus onchange="onChangeType(this.value);">
                @for($index=0; $index<4; $index++)
                    <option @if ($vehicleModel->type == $index) selected="true" @endif
                    value="{{$index}}">{{__('vehicle_branchs.type_'.$index)}}</option>
                @endfor
            </select>
            @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
            <label for="branch_id" class="control-label">{{ __('vehicle_branchs.branch_id') }}</label>
            <select id="branch_id" class="form-control" name="branch_id" required autofocus>
            </select>
            @if ($errors->has('branch_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('branch_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">{{ __('app.name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $vehicleModel->name) }}"
                   required>

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

@section('scripts')
    <script>
        const selectedBranch = {{ $vehicleModel->branch_id ? $vehicleModel->branch_id : "null"}};

        function onChangeType(value) {
            loading_show();
            $.getJSON("/json_branchs/" + value, function (data) {
                const branch = $("#branch_id");
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

        $(document).ready(function ($) {
            $("#type").change();
        });
    </script>
@endsection