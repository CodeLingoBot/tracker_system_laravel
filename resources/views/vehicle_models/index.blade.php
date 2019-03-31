@extends('layouts.app')
@section('title',__('vehicle_models.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('vehicle_models.index_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.new', ['url' => route('vehicle_models.create')])
        </div>
    </div>
@stop
@section('layout-content')
    <form method="GET" id="form-vehicle-branchs">
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="control-label">{{ __('vehicle_branchs.type') }}</label>
            <select id="type" type="text" class="form-control" required autofocus onchange="onChangeType(this.value);">
                @for($index=0; $index<4; $index++)
                    <option @if ($type == $index) selected="true" @endif
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
        <div class="form-group text-right">
            @include('layouts.partials.buttons.save', ['text'=>__('app.filter')])
        </div>
    </form>
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th>{{__('app.id')}}</th>
                <th>{{__('app.name')}}</th>
                <th>{!!__('vehicle_models.branch')!!}</th>
                <th colspan="2">{{__('app.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vehicleModels as $vehicleModel) {?>
            <tr>
                <th><?php echo $vehicleModel->id; ?></th>
                <th><?php echo $vehicleModel->name; ?></th>
                <th><?php echo $vehicleModel->branch->name; ?></th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url' => route('vehicle_models.edit', $vehicleModel)])
                </th>
                <th>
                    @include('layouts.partials.buttons.delete', ['url' => route('vehicle_models.destroy', $vehicleModel)])
                </th>
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$vehicleModels->appends(['type'=>$type, 'branch_id'=>$branchId])->links()}}
    </div>
@endsection

@section('scripts')
    <script>
        const selectedBranch = {{ $vehicleModel && $vehicleModel->branch_id ? $vehicleModel->branch_id : "null"}};

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