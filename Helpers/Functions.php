<?php

use MOCSolutions\Auth\Models\Permissao;
use MOCSolutions\Auth\Models\Usuario;

if (!function_exists('user')) {
    function user()
    {
        if (request()->session()->has('usuario')) {
            $user = request()->session()->get('usuario');

            $userDB = Usuario::find($user->id);
            $userDB->Permissoes = Permissao::getByUsuario($userDB->id);

            return $userDB;
        } else return null;
    }
}