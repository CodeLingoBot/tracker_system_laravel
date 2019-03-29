@extends('layouts.app')

@section('content')
@php($fromUser = isset($fromUser) ? $fromUser : Auth::user())
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {!! __('users.from') !!} [{{$fromUser->name}}]
                        </span>
                        <div class="btn-group pull-right btn-group-xs">
                            @if ($fromUser->id == \Auth::user()->id)
                                @include('layouts.partials.buttons.new', [
                                    'url' => route('users.create')
                                ])
                            @endif
                            @include('layouts.partials.buttons.back', [
                                'url' => route('users')
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                                            @include('layouts.partials.buttons.delete', ['url' => route('user.destroy', $user) ])
                                        </td>
                                        <td>
                                            @include('layouts.partials.buttons.show', ['url' => route('users.show', $user) ])
                                        </td>
                                        <td>
                                            @include('layouts.partials.buttons.show', [
                                                'url' => route('contacts.index')."?user_id=".$user->id,
                                                'text' => __('users.show_contacts')
                                            ])
                                        </td>
                                        <td>
                                            @include('layouts.partials.buttons.edit', ['url' => route('users.edit', $user) ])
                                        </td>
                                        @if ($user->hasRole('subadmin'))
                                            <td>
                                                @include('layouts.partials.buttons.show', [
                                                    'url' => url('user/' . $user->id . '/users'), 'text' => __('app.users') ])
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($pagintaionEnabled)
                            {{ $users->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
