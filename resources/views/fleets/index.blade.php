@extends('layouts.app')
@section('title',__('fleets.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('fleets.index_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.new', ['url' => route('fleets.create')])
        </div>
    </div>
@stop
@section('layout-content')
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th>{{__('app.id')}}</th>
                <th>{{__('app.name')}}</th>
                <th colspan="2">{{__('app.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fleets as $fleet) {?>
            <tr>
                <th><?php echo $fleet->id; ?></th>
                <th><?php echo $fleet->name; ?></th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url' => route('fleets.edit', $fleet)])
                </th>
                <th>
                    @include('layouts.partials.buttons.delete', ['url' => route('fleets.destroy', $fleet)])
                </th>
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$fleets->links()}}
    </div>
@endsection