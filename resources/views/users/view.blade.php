@extends('layouts.app')
@section('title', __('users.show_title'). ' ['.$user->name.']')
@section('content_header')
<div class="my-content-header">
    {{ __('users.show_title') }} [{{ $user->name }}]
    <div class="float-right">
        @include('layouts.partials.buttons.back', ['url' => route('users')])
    </div>
</div>
@stop
@section('layout-content')
<div class="row" style="margin: 20px auto;">
    <div class="col-md-offset-{{ !$user->isSubAdmin() ? 2:1 }} col-md-2 text-right">
        @include('layouts.partials.buttons.edit', ['url' => route('users.edit', $user)])
    </div>
    <div class="col-md-2 text-right">
        @include('layouts.partials.buttons.delete', ['url' => route('user.destroy', $user)])
    </div>
    <div class="col-md-2 text-right">
        @include('layouts.partials.buttons.show', [
            'url' => route('contacts.index')."?user_id=".$user->id,
            'text' => __('users.show_contacts'), 'icon' => 'fas fa-address-book',
            'class'=>'btn btn-secondary'
        ])
    </div>
    <div class="col-md-2 text-right">
        @include('layouts.partials.buttons.show', [
            'url' => route('vehicles.index',['final_user_id'=>$user->id]), 'text' => __('users.vehicles'), 'icon' => 'fa fa-car', 'class'=>'btn btn-success' ])
    </div>
    @if ($user->isSubAdmin())
        <div class="col-md-2 text-right">
            @include('layouts.partials.buttons.show', [
                'url' => url('user/' . $user->id . '/users'), 'text' => __('app.users'), 'icon' => 'fas fa-users', 'class'=>'btn btn-info' ])
        </div>
    @endif
</div>
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <strong>
                    {{ __('app.id') }}
                </strong>
            </div>
            <div class="col-md-8 col-sm-9">
                {{ $user->id }}
            </div>
        </div>
    </li>
    @if ($user->name)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ __('app.name') }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    {{ $user->name }}
                </div>
            </div>
        </li>
    @endif
    @if ($user->email)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ __('app.email') }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    {{ Html::mailto($user->email, $user->email) }}
                </div>
            </div>
        </li>
    @endif
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <strong>
                    {{ __('users.roles') }}
                </strong>
            </div>
            <div class="col-md-8 col-sm-9">
                @foreach ($user->roles as $user_role)
                    <span class="badge badge-default">{{ $user_role->name }}</span>
                @endforeach
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-4 col-sm-3">
                <strong>
                    {{ __('users.level') }}
                </strong>
            </div>
            <div class="col-md-8 col-sm-9">
                @for($level = $user->level(); $level>0; $level--)
                <span class="badge badge-primary margin-half margin-left-0">
                    <?php echo $level ?>
                </span>
                @endfor
            </div>
        </div>
    </li>
    @if ($user->created_at)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ __('users.created_at') }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    {{ $user->created_at->format(Setting::dateTime()) }}
                </div>
            </div>
        </li>
    @endif
    @if ($user->updated_at)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ __('users.updated_at') }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    {{ $user->updated_at->format(Setting::dateTime()) }}
                </div>
            </div>
        </li>
    @endif
    <li class="list-group-item bg-secondary">
        {{ __('users.contacts') }}
    </li>
    @foreach ($user->contacts as $contact)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ $contact->type->name }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    {{ $contact->value }}
                </div>
            </div>
        </li>
    @endforeach
    <li class="list-group-item bg-secondary">
        {{ __('users.users') }}
    </li>
    @foreach ($user->users as $user)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ $user->name }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    @include('layouts.partials.buttons.delete', ['url' => route('user.destroy', $user) ])
                    @include('layouts.partials.buttons.show', ['url' => route('users.show', $user) ])
                    @include('layouts.partials.buttons.show', [
                        'url' => route('contacts.index')."?user_id=".$user->id,
                        'text' => __('users.show_contacts'), 'icon' => 'fas fa-address-book',
                        'class'=>'btn btn-secondary'
                    ])
                    @include('layouts.partials.buttons.edit', ['url' => route('users.edit', $user) ])
                    @include('layouts.partials.buttons.show', [
                        'url' => route('vehicles.index',['final_user_id'=>$user->id]), 'text' => __('users.vehicles'), 'icon' => 'fa fa-car', 'class'=>'btn btn-success' ])
                    @if ($user->hasRole('subadmin'))
                        @include('layouts.partials.buttons.show', [
                            'url' => url('user/' . $user->id . '/users'), 'text' => __('app.users'), 'icon' => 'fas fa-users', 'class'=>'btn btn-info' ])
                    @endif
                </div>
            </div>
        </li>
    @endforeach
    <li class="list-group-item bg-secondary">
        {{ __('users.vehicles') }}
    </li>
    @foreach ($user->vehicles as $vehicle)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <strong>
                        {{ $vehicle->name }}
                    </strong>
                </div>
                <div class="col-md-8 col-sm-9">
                    @include('layouts.partials.buttons.edit', ['url' => route('vehicles.edit', $vehicle)])
                    @include('layouts.partials.buttons.delete', ['url' => route('vehicles.destroy', $vehicle)])
                </div>
            </div>
        </li>
    @endforeach
</ul>
@endsection
