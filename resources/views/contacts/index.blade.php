@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('contacts.index_title') }} [{{ $user->name }}]
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('contacts.create')."?user_id=". $user->id])
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
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
                                    <?php foreach ($contacts as $contact) { ?>
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
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$contacts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection