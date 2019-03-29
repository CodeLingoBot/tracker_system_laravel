@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('states.index_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('states.create')])
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
                                    <th>{{__('states.initials')}}</th>
                                    <th colspan="3">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($states as $state) { ?>
                                        <tr>
                                            <th><?php echo $state->id; ?></th>
                                            <th><?php echo $state->name; ?></th>
                                            <th><?php echo $state->initials; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('states.edit', $state)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('states.destroy', $state)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.show', ['url' => route('cities.index')."?state_id=".$state->id, 'text'=>__('states.cities')])
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$states->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection