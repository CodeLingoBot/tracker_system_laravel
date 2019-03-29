@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('cities.index_title') }} [{{ $state->name }}]
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('cities.create')])
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
                                    <th>{{__('cities.state')}}</th>
                                    <th colspan="2">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cities as $city) { ?>
                                        <tr>
                                            <th><?php echo $city->id; ?></th>
                                            <th><?php echo $city->name; ?></th>
                                            <th><?php echo $city->state->initials; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('cities.edit', $city)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('cities.destroy', $city)])
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$cities->appends(['state_id'=>$state->id])->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
