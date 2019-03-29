@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('vehicles.index_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('vehicles.create')])
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('app.id')}}</th>
                                    <th>{{__('app.name')}}</th>
                                    <th>{!!__('vehicles.uuid')!!}</th>
                                    <th>{!!__('vehicles.driver')!!}</th>
                                    <th colspan="2">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vehicles as $vehicle) { ?>
                                        <tr>
                                            <th><?php echo $vehicle->id; ?></th>
                                            <th><?php echo $vehicle->name; ?></th>
                                            <th><?php echo $vehicle->uuid; ?></th>
                                            <th><?php echo $vehicle->driver->name; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('vehicles.edit', $vehicle)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('vehicles.destroy', $vehicle)])
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$vehicles->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection