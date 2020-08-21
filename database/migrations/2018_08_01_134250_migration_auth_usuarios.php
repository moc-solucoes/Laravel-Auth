<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationAuthUsuarios extends Migration
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
            $table->string('nascimento')->nullable();
            $table->string('cpf')->nullable();
            $table->string('estado_civil')->nullable();
            $table->integer('sexo')->nullable();
            $table->string('token')->nullable();
            $table->string('senha')->nullable();
            $table->string('token_facebook')->nullable();
            $table->string('token_twitter')->nullable();
            $table->string('token_google')->nullable();
            $table->string('token_linkedin')->nullable();
            $table->timestamp('dt_criacao')->useCurrent();
            $table->timestamps();
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
