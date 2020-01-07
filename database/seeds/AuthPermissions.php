<?php

use Illuminate\Database\Seeder;
use MOCSolutions\Auth\Models\Perfil;
use MOCSolutions\Auth\Models\Permissao;

class AuthPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfil = Perfil::all()->first();

        $permissao = new Permissao();
        $permissao->nome = 'administrar.usuarios';
        $permissao->descricao = 'Permite administrar usuários.';
        $permissao->tipo = 'Administrativa';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);

        $permissao = new Permissao();
        $permissao->nome = 'administrar.usuarios.perfis';
        $permissao->descricao = 'Permite administrar os perfis do sistema.';
        $permissao->tipo = 'Administrativa';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);

        $permissao = new Permissao();
        $permissao->nome = 'administrar.usuarios.permissoes';
        $permissao->descricao = 'Permite administrar as permissões do usuário.';
        $permissao->tipo = 'Administrativa';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);

        $permissao = new Permissao();
        $permissao->nome = 'administrar.usuarios.secretarias';
        $permissao->descricao = 'Permite vincular os usuários às secretarias.';
        $permissao->tipo = 'Administrativa';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);
    }
}
