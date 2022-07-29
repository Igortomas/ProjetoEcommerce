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

Route::get('/', function () {
    return view('index');
});

Route::post('/login', 'App\Http\Controllers\UsuarioController@login')->name('login');

Route::get('/produtos', 'App\Http\Controllers\ProdutosController@index')->name('produtos');
Route::get('/produtos/novo', 'App\Http\Controllers\ProdutosController@create')->name('produtos.novo');
Route::post('/produtos/store', 'App\Http\Controllers\ProdutosController@store')->name('produtos.store');
Route::get('/produtos/edit/{id}', 'App\Http\Controllers\ProdutosController@edit')->name('produtos.edit');
Route::post('/produtos/update/{id}', 'App\Http\Controllers\ProdutosController@update')->name('produtos.update');