@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('settings.index.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/settings/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('settings.index.create_setting') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('settings.index.create_setting') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('settings.index.id')}}</th>
                                    <th class="hidden-xs">{{__('settings.index.key')}}</th>
                                    <th class="hidden-xs">{{__('settings.index.value')}}</th>
                                    <th class="no-search no-sort">{{__('settings.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($settings as $setting) { ?>
                                        <tr>
                                            <th><?php echo $setting->id; ?></th>
                                            <th class="hidden-xs"><?php echo $setting->key; ?></th>
                                            <th class="hidden-xs"><?php echo $setting->value; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('settings.edit', $setting)}}" data-toggle="tooltip" title="{{__('settings.index.edit')}}" class="btn btn-sm btn-warning btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('settings.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('settings.destroy', $setting)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('settings.index.remove')}}
                                                    </button>
                                                </form>
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

@section('scripts')
    <script>
        $(".delete").on("submit", function(){
            return confirm("{{__('settings.index.confirm_delete')}}");
        });
    </script>
@endsection
