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
Route::get('/cadastro', 'App\Http\Controllers\UsuarioController@create')->name('novo');
Route::post('/cadastro/store', 'App\Http\Controllers\UsuarioController@store')->name('store');

Route::get('/produtos', 'App\Http\Controllers\ProdutosController@index')->name('produtos');

Route::get('/admin/produtos', 'App\Http\Controllers\ProdutosController@indexadmin')->name('produtos');
Route::get('/admin/produtos/novo', 'App\Http\Controllers\ProdutosController@create')->name('produtos.novo');
Route::post('/admin/produtos/store', 'App\Http\Controllers\ProdutosController@store')->name('produtos.store');
Route::get('/admin/produtos/edit/{id}', 'App\Http\Controllers\ProdutosController@edit')->name('produtos.edit');
Route::post('/admin/produtos/update/{id}', 'App\Http\Controllers\ProdutosController@update')->name('produtos.update');
Route::get('/admin/produtos/apagar/{id}', 'App\Http\Controllers\ProdutosController@destroy')->name('produtos.destroy');
