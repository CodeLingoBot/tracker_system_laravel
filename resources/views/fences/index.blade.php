@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('fences.index.title') }}
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <a href="{{url('/fences/create')}}" data-toggle="tooltip"
                                   data-placement="left" title="{{ __('fences.index.create_fence') }}"
                                   class="btn btn-light btn-sm pull-right">
                                    <span class="hidden-xs hidden-sm">{{ __('fences.index.create_fence') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead class="thead">
                                <tr>
                                    <th>{{__('fences.index.id')}}</th>
                                    <th>{{__('fences.index.name')}}</th>
                                    <th class="no-search no-sort">{{__('fences.index.actions')}}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fences as $fence) { ?>
                                        <tr>
                                            <th><?php echo $fence->id; ?></th>
                                            <th><?php echo $fence->name; ?></th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('fences.show', $fence)}}" data-toggle="tooltip" title="{{__('fences.index.view')}}" class="btn btn-sm btn-info btn-block modal-iframe">
                                                    <i aria-hidden="true" class="fa fa-eye fa-fw"></i>
                                                    <span class="hidden-xs hidden-sm">{{__('fences.index.view')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <a href="{{route('fences.edit', $fence)}}" data-toggle="tooltip" title="{{__('fences.index.edit')}}" class="btn btn-sm btn-warning btn-block">
                                                    <i aria-hidden="true" class="fas fa-pencil-alt fa-fw"></i> <span class="hidden-xs hidden-sm">{{__('fences.index.edit')}}</span>
                                                </a>
                                            </th>
                                            <th class="no-search no-sort">
                                                <form class="delete" action="{{route('fences.destroy', $fence)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block">
                                                        <i aria-hidden="true" class="fa fa-trash fa-fw"></i>
                                                        {{__('fences.index.remove')}}
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            {{$fences->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('fences.index.modal.title')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" id="modal-iframe" frameborder="0" style="width: 100%; height:500px;"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".delete").on("submit", function(){
            return confirm("{{__('fences.index.confirm_delete')}}");
        });
        $(".modal-iframe").on("click", function(event){
            event.preventDefault();
            $("#modal-iframe").attr("src", this.href);
            $("#modal").modal("show");
        })
    </script>
@endsection
