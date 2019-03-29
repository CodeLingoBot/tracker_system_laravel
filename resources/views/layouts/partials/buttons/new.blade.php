<a href="{{ $url }}" class="{{ Setting::val('classe-botao-novo', 'btn btn-success') }}">
    <i aria-hidden="true" class="{{ Setting::val('classe-icone-novo', 'fa fa-plus') }} }}"></i>
    {{ isset($text) ? $text : __('app.new') }}
</a>