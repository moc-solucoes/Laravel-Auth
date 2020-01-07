<?php

use Illuminate\Database\Seeder;
use MOCSolutions\Auth\Models\Perfil;
use MOCSolutions\Auth\Models\Usuario;

class AuthPerfis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = Usuario::all()->first();

        $perfil = new Perfil();
        $perfil->nome = "Administrador";
        $perfil->save();
        $usuario->Perfis()->save($perfil);
    }
}
