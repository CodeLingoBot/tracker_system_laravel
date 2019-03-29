@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('states.index.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/states/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('states.index.create_state') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('states.index.create_state') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('states.index.id')}}</th>
                                    <th>{{__('states.index.name')}}</th>
                                    <th>{{__('states.index.initials')}}</th>
                                    <th class="no-search no-sort">{{__('roles.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($states as $state) { ?>
                                        <tr>
                                            <th><?php echo $state->id; ?></th>
                                            <th><?php echo $state->name; ?></th>
                                            <th><?php echo $state->initials; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('states.edit', $state)}}" data-toggle="tooltip" title="{{__('states.index.edit')}}" class="btn btn-sm btn-warning btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('states.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('states.destroy', $state)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('states.index.remove')}}
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$states->links()}}
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
            return confirm("{{__('states.index.confirm_delete')}}");
        });
    </script>
@endsection
