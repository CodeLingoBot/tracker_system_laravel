@extends('layouts.app')
@section('title',__('tracker_types.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('tracker_types.index_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.new', ['url' => route('tracker_types.create')])
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
            <?php foreach ($trackerTypes as $trackerType) {?>
            <tr>
                <th><?php echo $trackerType->id; ?></th>
                <th><?php echo $trackerType->name; ?></th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url' => route('tracker_types.edit', $trackerType)])
                </th>
                <th>
                    @include('layouts.partials.buttons.delete', ['url' => route('tracker_types.destroy', $trackerType)])
                </th>
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$trackerTypes->links()}}
    </div>
@endsection