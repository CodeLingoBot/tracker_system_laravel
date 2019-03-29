@extends('layouts.app')
@section('title', __('states.index_title'))
@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('states.index_title') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.new', ['url' => route('states.create')])
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
            <th>{{__('states.initials')}}</th>
            <th colspan="3">{{__('app.actions')}}</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($states as $state) {?>
                <tr>
                    <th><?php echo $state->id; ?></th>
                    <th><?php echo $state->name; ?></th>
                    <th><?php echo $state->initials; ?></th>
                    <th>
                        @include('layouts.partials.buttons.edit', ['url' => route('states.edit', $state)])
                    </th>
                    <th>
                        @include('layouts.partials.buttons.delete', ['url' => route('states.destroy', $state)])
                    </th>
                    <th>
                        @include('layouts.partials.buttons.show', ['url' => route('cities.index')."?state_id=".$state->id, 'text'=>__('states.cities')])
                    </th>
                </tr>
            <?php }?>
        </tbody>
    </table>
    {{$states->links()}}
</div>
@endsection