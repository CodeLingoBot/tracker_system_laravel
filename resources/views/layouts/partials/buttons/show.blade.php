<a href="{{ $url }}" class="{{ Setting::val('classe-botao-mostrar', 'btn btn-primary') }} {{isset($class) ? $class : ''}}">
    <i aria-hidden="true" class="{{ Setting::val('classe-icone-mostrar', 'fa fa-eye') }} }}"></i>
    {{ isset($text) ? $text : __('app.show') }}
</a>