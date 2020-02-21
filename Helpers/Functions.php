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

if (!function_exists('permissions')) {
    function permissions()
    {
        $user = user();

        if ($user) {
            return $user->Permissoes;
        } else return null;
    }
}

if (!function_exists('hasPermission')) {
    function hasPermission($permission)
    {
        $search = array_filter(user()->Permissoes, function ($value) use ($permission) {
            if ($permission == $value->nome) {
                return $value;
            }
        });

        return count($search) > 0;
    }
}

if (!function_exists('has_permission')) {
    function has_permission($permission)
    {
        $search = array_filter(user()->Permissoes, function ($value) use ($permission) {
            if ($permission == $value->nome) {
                return $value;
            }
        });

        return count($search) > 0;
    }
}