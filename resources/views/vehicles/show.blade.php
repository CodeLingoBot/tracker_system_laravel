@extends('layouts.app')
@section('title', __('vehicles.show_title'))
@section('content_header')
    <div class="my-content-header">
        <span>
            {{ __('vehicles.show_title') }}
        </span>
    </div>
@stop
@section('layout-content')
    <form>
        <div class="col-md-4 form-group">
            <label for="date-init" class="control-label">{{ __('vehicles.date-init') }}</label>
            <input id="date-init" type="text" class="form-control date" name="date-init"
                    value="{{ old('date-init') }}"
                    required>
        </div>
        <div class="col-md-4 form-group">
            <label for="date-end" class="control-label">{{ __('vehicles.date-end') }}</label>
            <input id="date-end" type="text" class="form-control date" name="date-end"
                    value="{{ old('date-end') }}"
                    required>
        </div>
        <div class="col-md-4 form-group">
            @include('layouts.partials.buttons.save')
        </div>
    </form>
    @if(isset($map))
        {!! $map['html'] !!}
        {!! $map['js'] !!}
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.date').datetimepicker({
                format: 'dd/mm/yyyy hh:ii',
            });
        });
    </script>
@endsection