<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Users Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-users'     => 'Mostrando todos os usuários',
    'users-menu-alt'        => 'Mostrar menu de gerenciamento de usuários',
    'create-new-user'       => 'Criar novo usuário',
    'show-deleted-users'    => 'Mostrar usuários removidos',
    'editing-user'          => 'Editando :name',
    'showing-user'          => 'Mostrando :name',
    'showing-user-title'    => 'Informações de :name',

    'users-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total users',
        'id'        => 'ID',
        'name'      => 'Nome',
        'email'     => 'Email',
        'role'      => 'Função',
        'created'   => 'Criado',
        'updated'   => 'Atualizado',
        'actions'   => 'Ações',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">Novo usuário</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Remover</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Voltar para </span><span class="hidden-xs">usuários</span>',
        'back-to-user'  => 'Voltar  <span class="hidden-xs">para usuário</span>',
        'delete-user'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Remover</span>',
        'edit-user'     => '<i class="fa fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Editar</span>',
    ],

    'tooltips' => [
        'delete'        => 'Remover',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Criar novo usuário',
        'back-users'    => 'Voltar para usuários',
        'email-user'    => 'Email :user',
        'submit-search' => 'Procurar',
        'clear-search'  => 'Limpar resultados',
    ],

    'messages' => [
        'userNameTaken'          => 'Usuario já selecionado',
        'userNameRequired'       => 'Usuario é requerido',
        'fNameRequired'          => 'Primeiro nome é requerido',
        'lNameRequired'          => 'Último nome é requerido',
        'emailRequired'          => 'Email é requerido',
        'emailInvalid'           => 'Email é inválido',
        'passwordRequired'       => 'Senha é requerida',
        'PasswordMin'            => 'Senha precisa ter no mínimo 6 caracteres',
        'PasswordMax'            => 'Senha pode ter no máximo 20 caracteres',
        'captchaRequire'         => 'Captcha é requerido',
        'CaptchaWrong'           => 'Captcha errado, tente novamente.',
        'roleRequired'           => 'Função é requerida.',
        'user-creation-success'  => 'Usuário criado!',
        'update-user-success'    => 'Usuário atualizado!',
        'delete-success'         => 'Usuário removido!',
        'cannot-delete-yourself' => 'Você não pode se remover!',
    ],

    'show-user' => [
        'id'                => 'ID',
        'name'              => 'Usuário',
        'email'             => '<span class="hidden-xs">Usuário </span>Email',
        'role'              => 'Função',
        'created'           => 'Criado <span class="hidden-xs">em</span>',
        'updated'           => 'Atualizado <span class="hidden-xs">em</span>',
        'labelRole'         => 'Função',
        'labelAccessLevel'  => '<span class="hidden-xs">Usuário</span> Nivel de acesso|<span class="hidden-xs">Usuário</span> Níveis de acesso',
    ],

    'search'  => [
        'title'         => 'Mostrando resultados da pesquisa',
        'found-footer'  => ' registro(s) encontrado(s)',
        'no-results'    => 'Sem resultados',
    ],
];
