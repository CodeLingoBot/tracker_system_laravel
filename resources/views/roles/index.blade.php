@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('roles.index_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('roles.create')])
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
                                    <th>{{__('app.description')}}</th>
                                    <th>{{__('roles.level')}}</th>
                                    <th>{{__('roles.slug')}}</th>
                                    <th colspan="2">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($roles as $role) { ?>
                                        <tr>
                                            <th><?php echo $role->id; ?></th>
                                            <th><?php echo $role->name; ?></th>
                                            <th><?php echo $role->description; ?></th>
                                            <th><?php echo $role->level; ?></th>
                                            <th><?php echo $role->slug; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('roles.edit', $role)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('roles.destroy', $role)])
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