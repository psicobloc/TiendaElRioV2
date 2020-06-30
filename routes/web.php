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
    return view('welcome');
});

Route::get('/caja', function () {
  $productos = \App\Producto::all();
  $categorias = \App\Categoria::all();

    return view('caja', ['productos' => $productos], ['categorias' => $categorias]);
});

Route::get('/prod', function () {
  $productos = \App\Producto::all();
  $categorias = \App\Categoria::all();

    return view('prod', ['productos' => $productos], ['categorias' => $categorias]);
});

Route::get('/historial', function () {
    $productos = \App\Producto::all();
    $categorias = \App\Categoria::all();




    return view('historial',  ['productos' => $productos], ['categorias' => $categorias]);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
