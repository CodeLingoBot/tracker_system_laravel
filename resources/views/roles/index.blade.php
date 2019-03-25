@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('roles.index.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/roles/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('roles.index.create_role') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('roles.index.create_role') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('roles.index.id')}}</th>
                                    <th class="hidden-xs">{{__('roles.index.name')}}</th>
                                    <th class="hidden-xs">{{__('roles.index.slug')}}</th>
                                    <th class="hidden-xs">{{__('roles.index.description')}}</th>
                                    <th class="hidden-xs">{{__('roles.index.level')}}</th>
                                    <th class="no-search no-sort">{{__('roles.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($roles as $role) { ?>
                                        <tr>
                                            <th><?php echo $role->id; ?></th>
                                            <th class="hidden-xs"><?php echo $role->name; ?></th>
                                            <th class="hidden-xs"><?php echo $role->slug; ?></th>
                                            <th class="hidden-xs"><?php echo $role->description; ?></th>
                                            <th class="hidden-xs"><?php echo $role->level; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('roles.edit', $role)}}" data-toggle="tooltip" title="{{__('roles.index.edit')}}" class="btn btn-sm btn-info btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('roles.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('roles.destroy', $role)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('roles.index.remove')}}
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$roles->links()}}
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
            return confirm("{{__('roles.index.confirm_delete')}}");
        });
    </script>
@endsection
