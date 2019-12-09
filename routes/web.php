<?php

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

//******************************Documentos***********************************************
Route::get('documentos/buscar/{id}','Mudanza\DocumentosController@busqueda_documentos');
Route::get('documentos/insertar','Mudanza\DocumentosController@insertar_documentos_api');
Route::get('documentos/eliminar/{id}','Mudanza\DocumentosController@eliminar_documentos_api');
Route::get('documentos/actualizar','Mudanza\DocumentosController@actualizar_documentos_api');
Route::get('documentos/listar','Mudanza\DocumentosController@listar_documentos');
/*** comentarios***/
Route::get('comentario_busqueda/{id}','Mudanza\ComentarioController@busqueda_comentario');
Route::get('ranking_busqueda/{id}','Mudanza\RankingController@busqueda_ranking');



Route::get('vehiculos/busqueda/{id_prestador}','Mudanza\VehiculoController@listarMiVehiculo');
Route::post('vehiculos/insertar','Mudanza\VehiculoController@insertarVehiculo');

Route::post('mudanzas/insertar','Mudanza\MudanzasController@insertarMudanza');
Route::get('mudazas/listarmismudanzas/{id}','Mudanza\MudanzasController@listarMisMudanzas');
Route::get('mudanza/listarmisservicios/{id}','Mudanza\MudanzasController@listarMisServicios');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**PRESTADOR DE SERVICIO */
Route::get('prestador/dashboard','Mudanza\PrestadorServicioController@dashboard');
