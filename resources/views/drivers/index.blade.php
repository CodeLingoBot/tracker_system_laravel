@extends('layouts.app')
@section('title',__('drivers.index_title'))

@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('drivers.index_title') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.new', ['url' => route('drivers.create')])
    </div>
</div>
@stop
@section('content')
<div class="table-responsive users-table">
    <table class="table table-striped table-sm data-table">
        <thead class="thead">
        <tr>
            <th>{{__('app.id')}}</th>
            <th>{{__('app.name')}}</th>
            <th>{!!__('drivers.license')!!}</th>
            <th colspan="2">{{__('app.actions')}}</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($drivers as $driver) {?>
                <tr>
                    <th><?php echo $driver->id; ?></th>
                    <th><?php echo $driver->name; ?></th>
                    <th><?php echo $driver->license->name; ?></th>
                    <th>
                        @include('layouts.partials.buttons.edit', ['url' => route('drivers.edit', $driver)])
                    </th>
                    <th>
                        @include('layouts.partials.buttons.delete', ['url' => route('drivers.destroy', $driver)])
                    </th>
                </tr>
            <?php }?>
        </tbody>
    </table>
    {{$drivers->links()}}
</div>
@endsection