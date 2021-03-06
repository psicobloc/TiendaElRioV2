<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    $categorias = \App\Categoria::all();

    return view('historial', ['categorias' => $categorias]);
});

Route::get('/crearticket', function () {
    $ordenes = \App\Ordene::all();

    return view('crearticket', ['ordenes' => $ordenes]);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Route::get('/cargar', function () {
//     return view('cargar');
// });

// Route::get('/tickets', function (Request $request) {
//
//
//     return view('crearticket', ['request' => $request]);
// });

Route::post('/cargar' ,function(Request $request){

  return view('cargar', ['request' => $request]);

  });


  // Route::post('/tickets', function (Request $request) {
  //
  //     return view('tickets', ['request' => $request]);
  // });
