@extends('layouts.app')
@section('title', __('settings.index_title'))

@section('content_header')
<div class="my-content-header">
    <span>
        {{ __('settings.index_title') }}
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @include('layouts.partials.buttons.new', ['url' => route('settings.create')])
    </div>
</div>
@stop
@section('content')
<div class="table-responsive users-table">
    <table class="table table-striped table-sm data-table">
        <thead class="thead">
        <tr>
            <th>{{__('app.id')}}</th>
            <th>{{__('settings.key')}}</th>
            <th>{{__('settings.value')}}</th>
            <th colspan="2">{{__('app.actions')}}</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($settings as $setting) {?>
                <tr>
                    <th><?php echo $setting->id; ?></th>
                    <th><?php echo $setting->key; ?></th>
                    <th><?php echo $setting->value; ?></th>
                    <th>
                        @include('layouts.partials.buttons.edit', ['url' => route('settings.edit', $setting)])
                    </th>
                    <th>
                        @include('layouts.partials.buttons.delete', ['url' => route('settings.destroy', $setting)])
                    </th>
                </tr>
            <?php }?>
        </tbody>
    </table>
    {{$settings->links()}}
</div>
@endsection