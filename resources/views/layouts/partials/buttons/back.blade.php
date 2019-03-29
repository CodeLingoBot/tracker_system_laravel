<a href="{{ $url }}" class="{{ Setting::val('classe-botao-voltar', 'btn btn-light') }}">
    <i aria-hidden="true" class="{{ Setting::val('classe-icone-voltar', 'fa fa-reply') }} }}"></i>
    {{ isset($text) ? $text : __('app.back') }}
</a>