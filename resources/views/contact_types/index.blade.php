@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('contact_types.index_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('contact_types.create')])
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('app.id')}}</th>
                                    <th>{{__('app.name')}}</th>
                                    <th>{!!__('contact_types.mask')!!}</th>
                                    <th colspan="2">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contactTypes as $contactType) { ?>
                                        <tr>
                                            <th><?php echo $contactType->id; ?></th>
                                            <th><?php echo $contactType->name; ?></th>
                                            <th><?php echo $contactType->mask; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('contact_types.edit', $contactType)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('contact_types.destroy', $contactType)])
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$contactTypes->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection