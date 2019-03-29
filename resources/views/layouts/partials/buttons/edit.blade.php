<a href="{{ $url }}" class="{{ Setting::val('classe-botao-editar', 'btn btn-warning') }}">
    <i aria-hidden="true" class="{{ Setting::val('classe-icone-editar', 'fa fa-pencil-alt') }} }}"></i>
    {{ isset($text) ? $text : __('app.edit') }}
</a>