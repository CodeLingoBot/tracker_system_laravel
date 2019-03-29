@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('contacts.index.title') }} [{{ $user->name }}]
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/users/'.$user->id)}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('contacts.edit.back_to_user') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('contacts.edit.back_to_user') }}</span>
                                </a>
                            </div>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/contacts/create')}}?user_id={{ $user->id }}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('contacts.index.create_contact') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('contacts.index.create_contact') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('contacts.index.id')}}</th>
                                    <th>{{__('contacts.index.type')}}</th>
                                    <th>{{__('contacts.index.value')}}</th>
                                    <th class="no-search no-sort">{{__('roles.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contacts as $contact) { ?>
                                        <tr>
                                            <th><?php echo $contact->id; ?></th>
                                            <th><?php echo $contact->type->name; ?></th>
                                            <th><?php echo $contact->value; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('contacts.edit', $contact)}}?user_id={{ $user->id }}" data-toggle="tooltip" title="{{__('contacts.index.edit')}}" class="btn btn-sm btn-warning btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('contacts.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('contacts.destroy', $contact)}}?user_id={{ $user->id }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('contacts.index.remove')}}
                                                    </button>
                                                </form>
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

@section('scripts')
    <script>
        $(".delete").on("submit", function(){
            return confirm("{{__('contacts.index.confirm_delete')}}");
        });
    </script>
@endsection
