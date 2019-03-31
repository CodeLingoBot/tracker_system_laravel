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
        {{$vehicleModels->links()}}
    </div>
@endsection