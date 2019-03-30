@extends('layouts.app')
@section('title', __('contacts.'.($contact->id?'edit':'new').'_title')." [". $user->name." ]")

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('contacts.'.($contact->id?'edit':'new').'_title') }} [{{ $user->name }}]
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.back', ['url'=>route('contacts.index')."?user_id=".$user->id])
        </div>
    </div>
@stop
@section('layout-content')
    <form class="" method="POST"
          action="{{ $contact->id ? route('contacts.update', $contact) : route('contacts.store') }}?user_id={{ $user->id }}"
          style="width: 100%;">
        {{ csrf_field() }}
        @if($contact->id) @method("PUT") @endif

        <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
            <label for="type_id" class="control-label">{{ __('app.type') }}</label>
            <select id="type_id" type="text" class="form-control" name="type_id"
                    value="{{ old('type', $contact->type) }}" required autofocus onchange="setMask();">
                @foreach($types as $type)
                    <option
                            value="{{ $type->id }}"
                            {!! $type->id == $contact->type_id ? 'selected="true"' : '' !!}
                            data-mask="{{ $type->mask }}"
                    >
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('type_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('type_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
            <label for="value" class="control-label">{{ __('app.value') }}</label>
            <input id="value" type="text" class="form-control" name="value" value="{{ old('value', $contact->value) }}"
                   required>

            @if ($errors->has('value'))
                <span class="help-block">
                    <strong>{{ $errors->first('value') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group text-right">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function setMask() {
            const selectEl = document.getElementById("type_id");
            const selected = selectEl.value;
            const mask = Array.prototype.slice.call(selectEl.children).filter(
                function (item) {
                    return item.value == selected;
                })[0].getAttribute('data-mask');
            window.VMask(document.getElementById("value")).maskPattern(mask);
        }

        $(function () {
            setMask();
        });
    </script>
@endsection