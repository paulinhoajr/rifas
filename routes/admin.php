<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\CampanhasController;
use App\Http\Controllers\Admin\PremiosController;
use App\Http\Controllers\Admin\PromocoesController;
use App\Http\Controllers\Admin\PixsController;
use App\Http\Controllers\Admin\CategoriasController;

Route::group(['prefix' => '/admin', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(AdminController::class)
        ->name('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::group(['prefix' => '/pixs'], function () {
        Route::controller(PixsController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('pixs.index');
                Route::get('/show/{id}', 'show')->name('pixs.show');
            });
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

                /*Route::post('/upload', 'upload')->name('campanhas.upload');
                Route::get('/remove/{id}', 'remove')->name('campanhas.remove');
                Route::get('/images/{id}', 'images')->name('campanhas.images');
                Route::get('/list/{id}', 'list')->name('campanhas.list');*/

            });
    });

    Route::group(['prefix' => '/premios'], function () {
        Route::controller(PremiosController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('premios.index');
                Route::get('/create', 'create')->name('premios.create');
                Route::post('/store', 'store')->name('premios.store');
                Route::get('/show/{id}', 'show')->name('premios.show');
                Route::get('/edit/{id}', 'edit')->name('premios.edit');
                Route::post('/update', 'update')->name('premios.update');
                Route::get('/delete/{id}', 'delete')->name('premios.delete');
                Route::get('/destroy/{id}', 'destroy')->name('premios.destroy');

                Route::post('/upload', 'upload')->name('premios.upload');
                Route::get('/remove/{id}', 'remove')->name('premios.remove');
                Route::get('/images/{id}', 'images')->name('premios.images');
                Route::get('/list/{id}', 'list')->name('premios.list');

            });
    });

    Route::group(['prefix' => '/promocoes'], function () {
        Route::controller(PromocoesController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('promocoes.index');
                Route::get('/create', 'create')->name('promocoes.create');
                Route::post('/store', 'store')->name('promocoes.store');
                Route::get('/show/{id}', 'show')->name('promocoes.show');
                Route::get('/edit/{id}', 'edit')->name('promocoes.edit');
                Route::post('/update', 'update')->name('promocoes.update');
                Route::get('/delete/{id}', 'delete')->name('promocoes.delete');
                Route::get('/destroy/{id}', 'destroy')->name('promocoes.destroy');

            });
    });

    Route::group(['prefix' => '/categorias'], function () {
        Route::controller(CategoriasController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('categorias.index');
                Route::get('/create', 'create')->name('categorias.create');
                Route::post('/store', 'store')->name('categorias.store');
                Route::get('/show/{id}', 'show')->name('categorias.show');
                Route::get('/edit/{id}', 'edit')->name('categorias.edit');
                Route::post('/update', 'update')->name('categorias.update');
                Route::get('/delete/{id}', 'delete')->name('categorias.delete');
                Route::get('/destroy/{id}', 'destroy')->name('categorias.destroy');

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

Route::resource('admin/sorteios', 'Admin\SorteiosController');*/
