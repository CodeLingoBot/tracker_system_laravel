@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('settings.index_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('settings.create')])
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('app.id')}}</th>
                                    <th>{{__('settings.key')}}</th>
                                    <th>{{__('settings.value')}}</th>
                                    <th colspan="2">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($settings as $setting) { ?>
                                        <tr>
                                            <th><?php echo $setting->id; ?></th>
                                            <th><?php echo $setting->key; ?></th>
                                            <th><?php echo $setting->value; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('settings.edit', $setting)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('settings.destroy', $setting)])
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$settings->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection