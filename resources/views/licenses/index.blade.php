@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('licenses.index_title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                @include('layouts.partials.buttons.new', ['url' => route('licenses.create')])
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
                                    <th colspan="2">{{__('app.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($licenses as $license) { ?>
                                        <tr>
                                            <th><?php echo $license->id; ?></th>
                                            <th><?php echo $license->name; ?></th>
                                            <th>
                                                @include('layouts.partials.buttons.edit', ['url' => route('licenses.edit', $license)])
                                            </th>
                                            <th>
                                                @include('layouts.partials.buttons.delete', ['url' => route('licenses.destroy', $license)])
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$licenses->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection