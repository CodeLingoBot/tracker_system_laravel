@extends('layouts.app')
@php($fromUser = isset($fromUser) ? $fromUser : Auth::user())
@section('title', __('users.from'). ' ['.$fromUser->name.']')
@section('content_header')
<div class="my-content-header">
    <span>
        {!! __('users.from') !!} [{{$fromUser->name}}]
    </span>
    <div class="btn-group pull-right btn-group-xs">
        @if ($fromUser->id == \Auth::user()->id)
            @include('layouts.partials.buttons.new', [
                'url' => route('users.create')
            ])
        @else
            @include('layouts.partials.buttons.back', [
              'url' => route('users')
            ])
        @endif
    </div>
</div>
@stop
@section('layout-content')
<div class="table-responsive users-table">
    <table class="table table-striped table-sm data-table">
        <thead class="thead">
            <tr>
                <th>
                    {{ __('app.id') }}
                </th>
                <th>
                    {{ __('app.name') }}
                </th>
                <th class="no-search no-sort" colspan="{{$fromUser->isAdmin() ? 5 : 4}}">
                    {{ __('app.actions') }}
                </th>
            </tr>
        </thead>
        <tbody id="users_table">
            @foreach($users as $user)
                <tr>
                    <td>
                        {{$user->id}}
                    </td>
                    <td>
                        {{$user->name}}<br>
                        @foreach ($user->roles as $user_role)
                        <span class="badge bg-primary">
                            {{ $user_role->name }}
                        </span>
                        @endforeach
                    </td>
                    <td>
                        @include('layouts.partials.buttons.show', ['url' => route('users.show', $user) ])
                    </td>
                    <td>
                        @include('layouts.partials.buttons.edit', ['url' => route('users.edit', $user) ])
                    </td>
                    <td>
                        @include('layouts.partials.buttons.delete', ['url' => route('user.destroy', $user) ])
                    </td>
                    <td>
                        @include('layouts.partials.buttons.show', [
                            'url' => route('contacts.index')."?user_id=".$user->id,
                            'text' => __('users.show_contacts'), 'icon' => 'fas fa-address-book',
                            'class'=>'btn btn-secondary'
                        ])
                    </td>
                    <td>
                        @include('layouts.partials.buttons.show', [
                            'url' => route('vehicles.index',['final_user_id'=>$user->id]), 'text' => __('users.vehicles'), 'icon' => 'fa fa-car', 'class'=>'btn btn-success' ])
                    </td>
                    <td>
                        @if ($user->hasRole('subadmin'))
                            @include('layouts.partials.buttons.show', [
                                'url' => url('user/' . $user->id . '/users'), 'text' => __('app.users'), 'icon' => 'fas fa-users', 'class'=>'btn btn-info' ])
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($pagintaionEnabled)
        {{ $users->links() }}
    @endif
</div>
@endsection
