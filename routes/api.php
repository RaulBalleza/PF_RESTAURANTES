<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('restaurants', 'RestaurantsController@list');
Route::get('restaurants/{id}', 'RestaurantsController@get');
Route::post('restaurants', 'RestaurantsController@create');
Route::put('restaurants/{id}', 'RestaurantsController@update');
Route::delete('restaurants/{id}', 'RestaurantsController@delete');

Route::get('menus', 'MenusController@list');
Route::get('menus/{id}', 'MenusController@get');
Route::post('menus', 'MenusController@create');
Route::put('menus/{id}', 'MenusController@update');
Route::delete('menus/{id}', 'MenusController@delete');

Route::get('pedidos', 'PedidosController@list');
Route::get('pedidos/{id}', 'PedidosController@get');
Route::get('/pedido/{id}/productos/', 'CustomController@getProductosPedido');
Route::post('pedidos', 'PedidosController@create');
Route::put('pedidos/{id}', 'PedidosController@update');
Route::delete('pedidos/{id}', 'PedidosController@delete');

Route::get('productos', 'ProductosController@list');
Route::get('productos/{id}', 'ProductosController@get');
Route::get('{id}/productos/', 'CustomController@getRestaurantMenu');
Route::post('productos', 'ProductosController@create');
Route::put('productos/{id}', 'ProductosController@update');
Route::delete('productos/{id}', 'ProductosController@delete');

Route::get('pedidohasproductos', 'PedidohasproductosController@list');
Route::get('pedidohasproductos/{id}', 'PedidohasproductosController@get');
Route::get('{id}/pedidos/', 'CustomController@getRestaurantPedidos');
Route::post('pedidohasproductos', 'PedidohasproductosController@create');
Route::put('pedidohasproductos/{id}', 'PedidohasproductosController@update');
Route::delete('pedidohasproductos/{id}', 'PedidohasproductosController@delete');
//