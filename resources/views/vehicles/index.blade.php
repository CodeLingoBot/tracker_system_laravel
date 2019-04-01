@extends('layouts.app')
@section('title', __('vehicles.index_title'))
@section('content_header')
    <div class="my-content-header">
        <span>
            {{ __('vehicles.index_title') }} [{{ $user->name }}]
        </span>
        @if(!$final)
            <div class="btn-group pull-right btn-group-xs">
                @include('layouts.partials.buttons.new', ['url' => route('vehicles.create', ['final_user_id' => $finalUserId])])
            </div>
        @endif
    </div>
@stop
@section('layout-content')
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th>{{__('app.id')}}</th>
                <th>{{__('app.name')}}</th>
                <th>{!!__('vehicles.uuid')!!}</th>
                <th>{!!__('vehicles.driver')!!}</th>
                <th colspan="{{$final?1:2}}">{{__('app.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vehicles as $vehicle) {?>
            <tr>
                <th><?php echo $vehicle->id; ?></th>
                <th><?php echo $vehicle->name; ?></th>
                <th><?php echo $vehicle->uuid; ?></th>
                <th><?php echo $vehicle->driver->name; ?></th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url' => route('vehicles.edit', $vehicle)])
                </th>
                @if(!$final)
                    <th>
                        @include('layouts.partials.buttons.delete', ['url' => route('vehicles.destroy', $vehicle)])
                    </th>
                @endif
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$vehicles->appends(['final_user_id' => $finalUserId])->links()}}
    </div>
@endsection