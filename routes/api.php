<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'MOCSolutions\Auth\Controllers\Mobile', 'prefix' => '/auth/mobile'], function () {
    Route::post('/login', 'UsuarioController@login')->name('mobile.usuario.logar');
});
