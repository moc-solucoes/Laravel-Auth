<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthPerfilPermissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_perfil_permissao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_perfil')->unsigned()->nullable();
            $table->foreign('id_perfil' )->references('id')->on('auth_perfis')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_permissao')->unsigned()->nullable();
            $table->foreign('id_permissao' )->references('id')->on('auth_permissoes')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('dt_criacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auth_perfil_permissao');
    }
}
