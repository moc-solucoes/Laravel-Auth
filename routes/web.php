<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'MOCSolutions\Auth\Controllers'], function () {
    Route::get('/login', 'UsuarioController@loginView')->name('login');
    Route::post('/login', 'UsuarioController@login')->name('usuario.logar');

    Route::group(['middleware' => ['web', \MOCSolutions\Auth\Middleware\Authenticate::class, \MOCSolutions\Auth\Middleware\Permission::class], 'prefix' => '/usuario'], function () {
        Route::get('/logout', 'UsuarioController@logout')->name('usuario.logout');
        Route::get('/meus-dados', 'UsuarioController@meusDados')->name('usuario.meus-dados');
        Route::post('/alterar-senha', 'UsuarioController@alterarSenha')->name('usuario.alterar-senha');
        Route::get('/recuperar-senha', 'UsuarioController@recuperarSenha')->name('usuario.recuperar-senha');
        Route::post('/recuperar-senha', 'UsuarioController@recuperarSenhaSalvar')->name('usuario.recuperar-senha');
        Route::get('/recuperar-senha/{token}', 'UsuarioController@recuperarSenhaToken')->name('usuario.recuperar-senha.token');
        Route::post('/recuperar-senha/{token}', 'UsuarioController@recuperarSenhaTokenSalvar')->name('usuario.recuperar-senha.token');
        Route::get('/cadastrar', 'UsuarioController@cadastrar')->name('usuario.cadastrar');
        Route::post('/cadastrar', 'UsuarioController@salvar')->name('usuario.cadastrar');

        Route::group(['prefix' => '/admin'], function () {
            Route::group(['prefix' => '/usuario'], function () {
                Route::get('/', 'Admin\UsuarioController@lista')->name('admin.usuario.listar');
                Route::get('/cadastrar', 'Admin\UsuarioController@cadastrar')->name('admin.usuario.cadastrar');
                Route::post('/cadastrar', 'Admin\UsuarioController@salvar')->name('admin.usuario.salvar');
                Route::get('/detalhes', 'Admin\UsuarioController@detalhes')->name('admin.usuario.detalhes');
            });
        });
    });
});
