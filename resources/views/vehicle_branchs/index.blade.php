@extends('layouts.app')
@section('title',__('vehicle_branchs.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('vehicle_branchs.index_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.new', ['url' => route('vehicle_branchs.create')])
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
                <th>{{__('vehicle_branchs.type')}}</th>
                <th colspan="2">{{__('app.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vehicleBranchs as $vehicleBranch) {?>
            <tr>
                <th><?php echo $vehicleBranch->id; ?></th>
                <th><?php echo $vehicleBranch->name; ?></th>
                <th><?php echo __('vehicle_branchs.type_'.$vehicleBranch->type); ?></th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url' => route('vehicle_branchs.edit', $vehicleBranch)])
                </th>
                <th>
                    @include('layouts.partials.buttons.delete', ['url' => route('vehicle_branchs.destroy', $vehicleBranch)])
                </th>
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$vehicleBranchs->links()}}
    </div>
@endsection