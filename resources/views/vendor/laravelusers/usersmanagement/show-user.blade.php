@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{ __('users.show_title') }} [{{ $user->name }}]
                        <div class="float-right">
                            @include('layouts.partials.buttons.back', ['url' => route('users')])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-4 text-right">
                            @include('layouts.partials.buttons.show', [
                                    'url' => route('contacts.index')."?user_id=".$user->id,
                                    'text' => __('users.show_contacts')
                                ])
                        </div>
                        <div class="col-4 text-center">
                            @include('layouts.partials.buttons.edit', ['url' => route('users.edit', $user)])
                        </div>
                        <div class="col-4 text-left">
                            @include('layouts.partials.buttons.delete', ['url' => route('user.destroy', $user)])
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 col-sm-3">
                                    <strong>
                                        {{ __('app.id') }}
                                    </strong>
                                </div>
                                <div class="col-8 col-sm-9">
                                    {{ $user->id }}
                                </div>
                            </div>
                        </li>
                        @if ($user->name)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {{ __('app.name') }}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if ($user->email)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-12 col-sm-3">
                                        <strong>
                                            {{ __('app.email') }}
                                        </strong>
                                    </div>
                                    <div class="col-12 col-sm-9">
                                        {{ Html::mailto($user->email, $user->email) }}
                                    </div>
                                </div>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 col-sm-3">
                                    <strong>
                                        {{ __('users.roles') }}
                                    </strong>
                                </div>
                                <div class="col-8 col-sm-9">
                                    @foreach ($user->roles as $user_role)
                                        <span class="badge badge-default">{{ $user_role->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <strong>
                                        {{ __('users.level') }}
                                    </strong>
                                </div>
                                <div class="col-12 col-sm-9">
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
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {{ __('users.created_at') }}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $user->created_at->format(Setting::dateTime()) }}
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if ($user->updated_at)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {{ __('users.updated_at') }}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $user->updated_at->format(Setting::dateTime()) }}
                                    </div>
                                </div>
                            </li>
                        @endif
                        @foreach ($user->contacts as $contact)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {{ $contact->type->name }}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $contact->value }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
