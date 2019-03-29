@extends('layouts.app')
@section('title', __('roles.index_title'))

@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('roles.index_title') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.new', ['url' => route('roles.create')])
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
            <th>{{__('app.description')}}</th>
            <th>{{__('roles.level')}}</th>
            <th>{{__('roles.slug')}}</th>
            <th colspan="2">{{__('app.actions')}}</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role) {?>
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
            <?php }?>
        </tbody>
    </table>
    {{$roles->links()}}
</div>
@endsection