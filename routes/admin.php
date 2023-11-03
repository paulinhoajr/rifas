<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\CampanhasController;

Route::group(['prefix' => '/admin', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(AdminController::class)
        ->name('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::group(['prefix' => '/usuarios'], function () {
        Route::controller(UsuarioController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('usuarios.index');
                Route::get('/create', 'create')->name('usuarios.create');
                Route::post('/store', 'store')->name('usuarios.store');
                Route::get('/show/{id}', 'show')->name('usuarios.show');
                Route::get('/edit/{id}', 'edit')->name('usuarios.edit');
                Route::post('/update', 'update')->name('usuarios.update');
                Route::get('/delete/{id}', 'delete')->name('usuarios.delete');
                Route::get('/destroy/{id}', 'destroy')->name('usuarios.destroy');
            });
    });

    Route::group(['prefix' => '/campanhas'], function () {
        Route::controller(CampanhasController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('campanhas.index');
                Route::get('/create', 'create')->name('campanhas.create');
                Route::post('/store', 'store')->name('campanhas.store');
                Route::get('/show/{id}', 'show')->name('campanhas.show');
                Route::get('/edit/{id}', 'edit')->name('campanhas.edit');
                Route::post('/update', 'update')->name('campanhas.update');
                Route::get('/delete/{id}', 'delete')->name('campanhas.delete');
                Route::get('/destroy/{id}', 'destroy')->name('campanhas.destroy');
            });
    });


    /*Route::group(['prefix' => '/documentos'], function () {
        Route::controller(DocumentoController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('documentos.index');
                Route::get('/create', 'create')->name('documentos.create');
                Route::post('/store', 'store')->name('documentos.store');
                Route::get('/show/{id}', 'show')->name('documentos.show');
                Route::get('/edit/{id}', 'edit')->name('documentos.edit');
                Route::post('/update', 'update')->name('documentos.update');
                Route::get('/delete/{id}', 'delete')->name('documentos.delete');
                Route::get('/destroy/{id}', 'destroy')->name('documentos.destroy');
            });
    });*/

})->middleware(['auth','admin', 'verified']);


/*Route::resource('admin/campanhas', 'Admin\CampanhasController');
Route::resource('admin/imagens', 'Admin\ImagensController');
Route::resource('admin/premios', 'Admin\PremiosController');
Route::resource('admin/promocoes', 'Admin\PromocoesController');
Route::resource('admin/bilhetes', 'Admin\BilhetesController');
Route::resource('admin/categorias', 'Admin\CategoriasController');
Route::resource('admin/sorteios', 'Admin\SorteiosController');*/
