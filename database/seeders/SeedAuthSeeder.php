<?php

use Database\Seeders\PermissoesSeed;
use MOCSolutions\Auth\Models\Usuario;
use MOCSolutions\Core\Models\Configuracao;
use Illuminate\Database\Seeder;

class SeedAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->saveUser();
        $this->saveConfig();

        $this->call([
            SeedAuthPerfis::class,
            PermissoesSeed::class,
        ]);
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
