<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PagamentoController;

Route::controller(HomeController::class)
    ->name('site.')
    //->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function() {
            return redirect('/home');
        });

        Route::get('/home', 'index')->name('index');
        Route::get('/campanha/{id}/{nome}', 'campanha')->name('campanha');

    });

Route::group(['prefix' => '/usuarios', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(UsuarioController::class)
        ->middleware(['auth', 'verified'])
        ->name('site.usuarios.')
        ->group(function () {
            Route::get('/', 'index')->name('index');

            Route::get('/edit', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');

        });

    Route::controller(UsuarioController::class)
        ->name('site.usuarios.')
        ->group(function () {

            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

        });

});

Route::group(['prefix' => '/pagamentos', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(PagamentoController::class)
        ->middleware(['auth', 'verified'])
        ->name('site.pagamentos.')
        ->group(function () {

            Route::post('/pagar', 'pagar')->name('pagar');

        });


});
