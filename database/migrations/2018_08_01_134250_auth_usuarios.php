<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_imagem')->unsigned()->nullable();
            $table->string('email');
            $table->string('nome');
            $table->string('nascimento');
            $table->string('cpf');
            $table->string('estado_civil');
            $table->integer('sexo');
            $table->string('token');
            $table->string('senha');
            $table->string('token_facebook');
            $table->string('token_twitter');
            $table->string('token_google');
            $table->string('token_linkedin');
            $table->timestamp('dt_criacao')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auth_usuarios');
    }
}
