@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('vehicles.index.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/vehicles/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('vehicles.index.create_vehicle') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('vehicles.index.create_vehicle') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('vehicles.index.id')}}</th>
                                    <th>{{__('vehicles.index.name')}}</th>
                                    <th>{{__('vehicles.index.uuid')}}</th>
                                    <th>{{__('vehicles.index.driver')}}</th>
                                    <th class="no-search no-sort">{{__('roles.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vehicles as $vehicle) { ?>
                                        <tr>
                                            <th><?php echo $vehicle->id; ?></th>
                                            <th><?php echo $vehicle->name; ?></th>
                                            <th><?php echo $vehicle->uuid; ?></th>
                                            <th><?php echo $vehicle->driver->name; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('vehicles.edit', $vehicle)}}" data-toggle="tooltip" title="{{__('vehicles.index.edit')}}" class="btn btn-sm btn-warning btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('vehicles.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('vehicles.destroy', $vehicle)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('vehicles.index.remove')}}
                                                    </button>
                                                </form>
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

@section('scripts')
    <script>
        $(".delete").on("submit", function(){
            return confirm("{{__('vehicles.index.confirm_delete')}}");
        });
    </script>
@endsection
