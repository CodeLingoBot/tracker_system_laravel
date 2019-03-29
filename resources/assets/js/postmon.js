function postmon_run_plugin() {
    (function($) {
        $.postmon = {
            obj: [],
            filtrar_json: false,
            endpoint_method: "POST",
            paises_endpoint: "pais.json",
            estados_endpoint: "estado.json",
            cidades_endpoint: "cidade.json",
            loading: null,
            montar: function(select, dados) {
                $(select).children().remove();
                dados.forEach(function(item) {
                    const option = $("<option value=" + item.id + ">" + item.nome + "</option>");
                    for (var chave in item) {
                        option.data(chave, item[chave]);
                    }
                    $(select).append(option);
                });
            },
            paises: function(select) {
                if($.postmon.loading) $($.postmon.loading).show();
                $.ajax({
                    type: $.postmon.endpoint_method,
                    async: false,
                    url: $.postmon.paises_endpoint,
                    dataType: 'json',
                    success: function(dados) {
                        $.postmon.montar(select, dados);
                        if($.postmon.loading) $($.postmon.loading).hide();
                    }
                });
            },
            estados: function(select, pais_id) {
                if($.postmon.loading) $($.postmon.loading).show();
                $.ajax({
                    type: $.postmon.endpoint_method,
                    async: false,
                    url: $.postmon.estados_endpoint,
                    data: {
                        "id": pais_id
                    },
                    dataType: 'json',
                    success: function(dados) {
                        if ($.postmon.filtrar_json) {
                            dados = $.postmon.filtrar(dados, 'pais_id', pais_id);
                        }
                        $.postmon.montar(select, dados);
                        if($.postmon.loading) $($.postmon.loading).hide();
                    }
                });
            },
            cidades: function(select, estado_id) {
                if($.postmon.loading) $($.postmon.loading).show();
                $.ajax({
                    type: $.postmon.endpoint_method,
                    async: false,
                    url: $.postmon.cidades_endpoint,
                    data: {
                        "id": estado_id
                    },
                    dataType: 'json',
                    success: function(dados) {
                        if ($.postmon.filtrar_json) {
                            dados = $.postmon.filtrar(dados, 'estado_id', estado_id);
                        }
                        $.postmon.montar(select, dados);
                        if($.postmon.loading) $($.postmon.loading).hide();
                    },
                });
            },
            primeiro: function(select) {
                const opcoes = select.children('option');
                if (opcoes.length == 0) {
                    return null;
                }
                return opcoes[0].value;
            },
            filtrar: function(dados, chave, valor) {
                return dados.filter(function(el) {
                    return el[chave] == valor;
                });
            },
            uuid: function(el) {
                return el.data('postmon-jquery-uuid');
            },
            parsar: function(select, selecionado, chave) {
                if (!selecionado) {
                    return $.postmon.primeiro(select);
                }
                if (!isNaN(selecionado * 1)) {
                    return selecionado;
                }
                return select.children().filter(function() {
                    return $(this).data(chave) == selecionado;
                }).val();
            },
            cep: function(uuid) {
                if($.postmon.loading) $($.postmon.loading).show();
                let cepLimpo = $.postmon.obj[uuid].input.cep.val().match(/\d/g).join("");
                $.ajax({
                    url: 'https://api.postmon.com.br/v1/cep/' + cepLimpo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(dados) {
                        $.postmon.obj[uuid].selected = {
                            pais: 0,
                            estado: dados.estado,
                            cidade: dados.cidade
                        }
                        $.postmon.obj[uuid].select.pais.val($.postmon.obj[uuid].selected.pais).change();
                        $.postmon.obj[uuid].input.bairro.val(dados.bairro);
                        $.postmon.obj[uuid].input.endereco.val(dados.logradouro);
                        if($.postmon.loading) $($.postmon.loading).hide();
                    }
                });
            },
            eventos: {
                estado: function(uuid) {
                    const select_cidade = $.postmon.obj[uuid].select.cidade;
                    $.postmon.cidades(select_cidade, $.postmon.obj[uuid].select.estado.val());
                    $.postmon.obj[uuid].selected.cidade = $.postmon.parsar(select_cidade, $.postmon.obj[uuid].selected.cidade, 'nome');
                    select_cidade.val($.postmon.obj[uuid].selected.cidade);
                },
                pais: function(uuid) {
                    const pais_id = $.postmon.obj[uuid].select.pais.val();
                    $.postmon.obj[uuid].selected.pais = pais_id;
                    const select_estado = $.postmon.obj[uuid].select.estado;
                    $.postmon.estados(select_estado, pais_id);
                    select_estado.change(function() {
                        $.postmon.eventos.estado(uuid);
                    });
                    $.postmon.obj[uuid].selected.estado = $.postmon.parsar(select_estado, $.postmon.obj[uuid].selected.estado, 'sigla');
                    select_estado.val($.postmon.obj[uuid].selected.estado).change();
                }
            },
            uuid: function() {
                return Math.random().toString(36).substring(2) + (new Date()).getTime().toString(36);
            }
        }
        $.fn.postmon = function({
            select = {
                pais,
                estado,
                cidade
            },
            input = {
                cep: $("<input type='text'>"),
                bairro: $("<input type='text'>"),
                endereco: $("<input type='text'>")
            },
            selected = {
                pais: null,
                estado: null,
                cidade: null
            }
        }) {
            const uuid = $.postmon.uuid();
            $.postmon.obj[uuid] = {
                select: select,
                input: input,
                selected: selected
            }
            const obj = $.postmon.obj[uuid];
            $.postmon.paises(obj.select.pais);
            obj.select.pais.change(function() {
                $.postmon.eventos.pais(uuid);
            });
            obj.select.pais.val(selected.pais || $.postmon.primeiro(obj.select.pais)).change();
            obj.input.cep.change(function() {
                $.postmon.cep(uuid, obj.input.cep);
            });
        };
    }(jQuery));
}
(function() {
    if (!window.jQuery) {
        var script = document.createElement("SCRIPT");
        script.src = 'https://code.jquery.com/jquery-3.3.1.min.js';
        script.type = 'text/javascript';
        script.onload = function() {
            var $ = window.jQuery;
            postmon_run_plugin();
        };
        document.getElementsByTagName("head")[0].appendChild(script);
    } else {
        postmon_run_plugin();
    }
})();