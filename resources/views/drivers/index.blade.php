@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('drivers.index.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/drivers/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('drivers.index.create_driver') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('drivers.index.create_driver') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('drivers.index.id')}}</th>
                                    <th>{{__('drivers.index.name')}}</th>
                                    <th>{{__('drivers.index.license')}}</th>
                                    <th class="no-search no-sort">{{__('roles.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($drivers as $driver) { ?>
                                        <tr>
                                            <th><?php echo $driver->id; ?></th>
                                            <th><?php echo $driver->name; ?></th>
                                            <th><?php echo $driver->license->name; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('drivers.edit', $driver)}}" data-toggle="tooltip" title="{{__('drivers.index.edit')}}" class="btn btn-sm btn-warning btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('drivers.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('drivers.destroy', $driver)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('drivers.index.remove')}}
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$drivers->links()}}
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
            return confirm("{{__('drivers.index.confirm_delete')}}");
        });
    </script>
@endsection
