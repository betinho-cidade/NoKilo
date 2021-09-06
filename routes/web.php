<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/logout', 'HomeController@logout')->name('logout')->middleware('auth');

Route::post('/js_viacep', 'Painel\PainelController@js_viacep')->name('painel.js_viacep');
//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//Route::get('/', 'Painel\PainelController@index')->name('painel')->middleware('auth');


Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Painel'], function(){

        Route::get('/', 'PainelController@index')->name('painel');

        Route::group(['namespace' => 'Cadastro'], function(){
            Route::group(['namespace' => 'Usuario'], function(){
                Route::get('/usuario', 'UsuarioController@index')->name('usuario.index');
                Route::get('/usuario/create', 'UsuarioController@create')->name('usuario.create');
                Route::post('/usuario/store', 'UsuarioController@store')->name('usuario.store');
                Route::get('/usuario/{usuario}', 'UsuarioController@show')->name('usuario.show');
                Route::put('/usuario/{usuario}/update', 'UsuarioController@update')->name('usuario.update');
                Route::delete('/usuario/{usuario}/destroy', 'UsuarioController@destroy')->name('usuario.destroy');
            });
            Route::group(['namespace' => 'Franquia'], function(){
                Route::get('/franquia', 'FranquiaController@index')->name('franquia.index');
                Route::post('/franquia/js_viacep', 'FranquiaController@js_viacep')->name('franquia.js_viacep');
                Route::get('/franquia/create', 'FranquiaController@create')->name('franquia.create');
                Route::post('/franquia/store', 'FranquiaController@store')->name('franquia.store');
                Route::get('/franquia/{franquia}', 'FranquiaController@show')->name('franquia.show');
                Route::put('/franquia/{franquia}/update', 'FranquiaController@update')->name('franquia.update');
                Route::delete('/franquia/{franquia}/destroy', 'FranquiaController@destroy')->name('franquia.destroy');
            });
            Route::group(['namespace' => 'Promocao'], function(){
                Route::get('/promocao', 'PromocaoController@index')->name('promocao.index');
                Route::get('/promocao/create', 'PromocaoController@create')->name('promocao.create');
                Route::post('/promocao/store', 'PromocaoController@store')->name('promocao.store');
                Route::get('/promocao/{promocao}', 'PromocaoController@show')->name('promocao.show');
                Route::put('/promocao/{promocao}/update', 'PromocaoController@update')->name('promocao.update');
                Route::delete('/promocao/{promocao}/destroy', 'PromocaoController@destroy')->name('promocao.destroy');
            });
        });

        Route::group(['namespace' => 'Movimento'], function(){
            Route::group(['namespace' => 'Nota'], function(){
                Route::get('/nota', 'NotaController@index')->name('nota.index');
                Route::get('/nota/create', 'NotaController@create')->name('nota.create');
                Route::post('/nota/store', 'NotaController@store')->name('nota.store');
                Route::get('/nota/{nota}', 'NotaController@show')->name('nota.show');
                Route::put('/nota/{nota}/update', 'NotaController@update')->name('nota.update');
                Route::get('/nota/{nota}/download', 'NotaController@download')->name('nota.download');
                Route::delete('/nota/{nota}/destroy', 'NotaController@destroy')->name('nota.destroy');
            });
            Route::group(['namespace' => 'Score'], function(){
                Route::get('/score', 'ScoreController@index')->name('score.index');
                Route::get('/score/{promocao}/{user}/show', 'ScoreController@show')->name('score.show');
            });
        });

    });

});

//** Páginas de Acesso pelo Portal, para cadastro de novos Membros **/
Route::group(['namespace' => 'Guest'], function(){

    Route::group(['namespace' => 'Cadastro\Visitante'], function(){
        Route::get('/visitante', 'VisitanteController@create')->name('visitante.create');
        Route::post('/visitante/store', 'VisitanteController@store')->name('visitante.store');
        Route::post('/visitante/js_viacep', 'VisitanteController@js_viacep')->name('visitante.js_viacep');
    });
});

