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

        Route::get('/teste', 'teste')->name('teste');
        Route::get('/webhook', 'webhook')->name('webhook');

        Route::get('/cielo_pix_consulta', 'cielo_pix_consulta')->name('cielo_pix_consulta');
        Route::get('/numeros_reservados_consulta', 'numeros_reservados_consulta')->name('numeros_reservados_consulta');

    });

Route::group(['prefix' => '/usuarios', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(UsuarioController::class)
        ->middleware(['auth', 'verified'])
        ->name('site.usuarios.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/campanhas', 'campanhas')->name('campanhas');

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

            Route::post('/avancar', 'avancar')->name('avancar');
            Route::get('/pagar/selecionar/{id}', 'pagar_selecionar')->name('pagar_selecionar');
            Route::post('/pagar/pix', 'pagar_pix')->name('pagar_pix');
            Route::post('/pagar/pix/post', 'pagar_pix_post')->name('pagar_pix_post');

            Route::get('/pagar/selecionar/{id}', 'pagar_selecionar')->name('pagar_selecionar');
            Route::get('/imprimirPix/{pix_id}', 'imprimirPix')->name('imprimirPix');

            Route::post('/pagar/cartao', 'pagar_cartao')->name('pagar_cartao');

            Route::get('/bilhete/excluir/{id}', 'excluir_numero')->name('excluir_numero');
            Route::get('/compra/excluir/{id}', 'excluir_compra')->name('excluir_compra');

        });


});
