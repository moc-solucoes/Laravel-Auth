<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'MOCSolutions\Auth\Controllers', 'prefix' => '/auth'], function () {
    Route::group(['prefix' => '/login'], function (){
        Route::get('/', 'UsuarioController@loginView')->name('login');
        Route::post('/', 'UsuarioController@login')->name('usuario.logar');
        Route::get('/social/{tipo}', 'UsuarioController@loginSocial')->name('auth.user.login.social');
        Route::get('/social-callback/{tipo}', 'UsuarioController@login')->name('auth.user.login.calback.social');
    });

    Route::get('/error/401', function() {
        return view("Auth::admin.error.401");
    })->name('auth.admin.error.401');

    Route::group(['middleware' => ['authenticate', 'permission']], function () {
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
            Route::group(['prefix' => '/usuario', 'namespace' => 'Admin'], function () {
                Route::get('/', 'UsuarioController@lista')->name('auth.admin.usuario');
                Route::get('/cadastrar', 'UsuarioController@cadastrar')->name('auth.admin.usuario.cadastrar');
                Route::post('/cadastrar', 'UsuarioController@salvar')->name('auth.admin.usuario.salvar');
                Route::get('/editar/{id?}', 'UsuarioController@editar')->name('auth.admin.usuario.editar');
                Route::get('/excluir/{id}', 'UsuarioController@excluir')->name('auth.admin.usuario.excluir');
                Route::get('/restaurar/{id}', 'UsuarioController@restaurar')->name('auth.admin.usuario.restaurar');
                Route::post('/editar/{id?}', 'UsuarioController@salvarEditar')->name('auth.admin.usuario.editar');

                Route::group(['prefix' => '/perfil'], function () {
                    Route::get('/', 'UsuarioController@perfis')->name('auth.admin.usuario.perfil');
                    Route::get('/cadastrar', 'UsuarioController@cadastrarPerfil')->name('auth.admin.usuario.perfil.cadastrar');
                    Route::post('/cadastrar', 'UsuarioController@salvarPerfil')->name('auth.admin.usuario.perfil.cadastrar');
                    Route::get('/editar/{id?}', 'UsuarioController@editarPerfil')->name('auth.admin.usuario.perfil.editar');
                    Route::post('/editar/{id?}', 'UsuarioController@salvarEditarPerfil')->name('auth.admin.usuario.perfil.editar');
                });

                Route::group(['prefix' => '/permissoes'], function () {
                    Route::get('/', 'UsuarioController@permissoes')->name('auth.admin.usuario.permissao');
                    Route::get('/cadastrar', 'UsuarioController@cadastrarPermissao')->name('auth.admin.usuario.permissao.cadastrar');
                    Route::post('/cadastrar', 'UsuarioController@salvarPermissao')->name('auth.admin.usuario.permissao.cadastrar');
                    Route::get('/editar/{id}', 'UsuarioController@editarPermissao')->name('auth.admin.usuario.permissao.editar');
                    Route::post('/editar/{id}', 'UsuarioController@salvarEdicaoPermissao')->name('auth.admin.usuario.permissao.editar');
                });
            });

            Route::group(['prefix' => '/api', 'namespace' => 'Api'], function () {
                Route::group(['prefix' => '/usuario'], function () {
                    Route::post('/lista', 'UsuarioController@index')->name('auth.admin.api.usuario');
                    Route::post('/perfil/lista', 'UsuarioController@perfis')->name('auth.admin.api.usuario.perfil');
                    Route::post('/permissao/lista', 'UsuarioController@permissoes')->name('auth.admin.api.usuario.permissao');
                });
            });
        });
    });
});
