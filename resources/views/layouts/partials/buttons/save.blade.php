<button class="{{ Setting::val('classe-botao-salvar', 'btn btn-success') }}">
    <i aria-hidden="true" class="{{ Setting::val('classe-icone-salvar', 'fa fa-save') }} }}"></i>
    {{ isset($text) ? $text : __('app.submit') }}
</button>