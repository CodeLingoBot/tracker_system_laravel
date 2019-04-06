<form class="delete" action="{{$url}}" method="POST" style="display: inline;">
    <input type="hidden" name="_method" value="DELETE">
    {{ csrf_field() }}
    <button type="submit" class="{{ Setting::val('classe-botao-remover', 'btn btn-danger') }}">
        <i aria-hidden="true" class="{{ Setting::val('classe-icone-remover', 'fa fa-trash') }}"></i>
            {{ isset($text) ? $text : __('app.remove') }}
    </button>
</form>