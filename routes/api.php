<?php

use Illuminate\Http\Request;

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

Route::group(['prefix'=>'auth'],function(){
	Route::get('busqueda_id/{id}','Mudanza\DocumentosController@busqueda_id');
    //Apis para actualizar,eliminar y listar uno o varios clientes
    Route::group(['prefix'=>'cliente'],function(){   
    Route::get('listarcliente','Mudanza\ClienteController@listarclientes');
    Route::get('busquedacliente_id/{id}','Mudanza\ClienteController@busquedacliente_id');
    Route::post('agregar_cliente','Mudanza\ClienteController@agregar_cliente');
    Route::post('actualizar_cliente/{cliente}','Mudanza\ClienteController@actualizar_cliente');
    Route::post('eliminar_cliente/{id}','Mudanza\ClienteController@eliminar_cliente');
    });
});
