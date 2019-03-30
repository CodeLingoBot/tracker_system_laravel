@extends('layouts.app')
@section('title', __('contacts.index_title')." [". $user->name." ]")

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('contacts.index_title') }} [{{ $user->name }}]
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.new', ['url' => route('contacts.create')."?user_id=". $user->id])
        </div>
    </div>
@stop
@section('layout-content')
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th>{{__('app.id')}}</th>
                <th>{{__('app.value')}}</th>
                <th>{!!__('contacts.type')!!}</th>
                <th colspan="2">{{__('app.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) {?>
            <tr>
                <th><?php echo $contact->id; ?></th>
                <th><?php echo $contact->value; ?></th>
                <th><?php echo $contact->type->name; ?></th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url' => route('contacts.edit', $contact)."?user_id=".$user->id])
                </th>
                <th>
                    @include('layouts.partials.buttons.delete', ['url' => route('contacts.destroy', $contact)."?user_id=".$user->id])
                </th>
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$contacts->links()}}
    </div>
@endsection