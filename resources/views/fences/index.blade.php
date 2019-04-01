@extends('layouts.app')
@section('title',__('fences.index_title'))

@section('content_header')
    <div class="my-content-header">
    <span>
        {{ __('fences.index_title') }}
    </span>
        <div class="btn-group pull-right btn-group-xs">
            @include('layouts.partials.buttons.new', ['url'=>route('fences.create')])
        </div>
    </div>
@stop
@section('layout-content')
    <div class="table-responsive users-table">
        <table class="table table-striped table-sm data-table">
            <thead class="thead">
            <tr>
                <th>{{__('app.id')}}</th>
                <th>{{__('app.name')}}</th>
                <th colspan="3">{{__('app.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fences as $fence) {?>
            <tr>
                <th><?php echo $fence->id; ?></th>
                <th><?php echo $fence->name; ?></th>
                <th>
                    @include('layouts.partials.buttons.show', ['url'=>route('fences.show', $fence), 'class'=>'modal-iframe'])
                </th>
                <th>
                    @include('layouts.partials.buttons.edit', ['url'=>route('fences.edit', $fence)])
                </th>
                <th>
                    @include('layouts.partials.buttons.delete', ['url'=>route('fences.destroy', $fence)])
                </th>
            </tr>
            <?php }?>
            </tbody>
        </table>
        {{$fences->links()}}
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('fences.view_title')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='$("#modal").hide();'>
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
        $(document).ready(function ($) {
            $(".modal-iframe").on("click", function (event) {
                event.preventDefault();
                $("#modal-iframe").attr("src", this.href);
                $("#modal").show();
            });
        });
    </script>
@endsection
