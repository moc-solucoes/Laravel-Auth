<?php

use MOCSolutions\Auth\Models\Perfil;
use MOCSolutions\Auth\Models\Permissao;
use MOCSolutions\Auth\Models\Usuario;
use MOCSolutions\Core\Models\Configuracao;
use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = $this->saveConfig();
        $usuario = $this->saveUser();
        $perfil = $this->saveProfile($usuario);
    }

    private function saveUser()
    {
        $pass = password(md5("moc@2019"));

        $usuario = new Usuario();
        $usuario->email = 'maike@mocsolucoes.com.br';
        $usuario->nome = 'Administrador - MOC Soluções';
        $usuario->token = $pass["salt"];
        $usuario->senha = $pass["password"];
        $usuario->save();

        return $usuario;
    }

    private function saveProfile($usuario)
    {
        $perfil = new Perfil();
        $perfil->nome = "Administrador";
        $perfil->save();

        $usuario->Perfis()->save($perfil);

        $permissao = new Permissao();
        $permissao->nome = 'administrar.usuarios';
        $permissao->descricao = 'Permite administrar usuários.';
        $permissao->tipo = 'Administrador';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);

        $permissao = new Permissao();
        $permissao->nome = 'administrar.faturas';
        $permissao->descricao = 'Permite administrar faturas.';
        $permissao->tipo = 'Administrador';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);

        $permissao = new Permissao();
        $permissao->nome = 'administrar.documentos';
        $permissao->descricao = 'Permite administrar documentos.';
        $permissao->tipo = 'Administrador';
        $permissao->grupo = 'Admin';
        $permissao->save();
        $perfil->Permissoes()->save($permissao);

        return $perfil;
    }

    private function saveConfig()
    {
        $configuracao = new Configuracao();
        $configuracao->coluna = 'geral';
        $std = new stdClass();
        $std->logo = asset("images/logo.png");
        $configuracao->setValores($std);
        $configuracao->save();

        return $configuracao;
    }
}
