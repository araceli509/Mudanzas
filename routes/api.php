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

    //Apis para la actualizacion,resgistro,eliminacion y listado de uno o mas usuarios
    Route::group(['prefix'=>'cliente'],function(){
    Route::get('listarcliente','Mudanza\ClienteController@listarclientes');
    Route::get('busquedacliente_id/{id}','Mudanza\ClienteController@busquedacliente_id');
    Route::post('agregar_cliente','Mudanza\ClienteController@agregar_cliente');
    Route::post('actualizar_cliente/{cliente}','Mudanza\ClienteController@actualizar_cliente');
    Route::post('eliminar_cliente/{id}','Mudanza\ClienteController@eliminar_cliente');
    Route::get('busquedacliente_correo/{correo}','Mudanza\ClienteController@busquedacliente_correo');
    });

    Route::group(['prefix'=>'reservacion','headers' => ['Accept' => 'application/json']],function(){
        Route::get('listarreservaciones','Mudanza\ReservacionController@listarreservaciones');
        Route::get('busquedareservacion_id/{id}','Mudanza\ReservacionController@busquedareservacion_id');
        Route::post('agregar_reservacion','Mudanza\ReservacionController@agregar_reservacion');
        Route::post('actualizar_reservacion/{reservacion}','Mudanza\ReservacionController@actualizar_reservacion');
        Route::post('eliminar_reservacion/{id}','Mudanza\ReservacionController@eliminar_reservacion');
        Route::post('aceptar_reservacion/{id}','Mudanza\ReservacionController@aceptar_reservacion');
        Route::get('reservaciones/{id_cliente}','Mudanza\ReservacionController@reservaciones');
        Route::get('reservaciones_usuario/{ide}','Mudanza\ReservacionController@buscarreservacionporusuario');
        Route::get('buscar/{id}','Mudanza\ReservacionController@buscar_reservacion');
        });


	Route::get('busqueda_id_comentario/{id}','Mudanza\ComentarioController@busqueda_id_comentario');
	Route::get('busqueda_id_ranking/{id}','Mudanza\RankingController@busqueda_id_ranking');

		//********************************Comentarios***************************************************
	 Route::group(['prefix'=>'comentario'],function(){
    Route::get('listarcomentario','Mudanza\ComentarioController@listarcomentarios');
    Route::get('busquedacomentario_id/{id}','Mudanza\ComentarioController@busquedacomentario_id');
    Route::post('agregar_comentario','Mudanza\ComentarioController@agregar_comentario');
    Route::post('actualizar_comentario/{comentario}','Mudanza\ComentarioController@actualizar_comentario');
    Route::post('eliminar_comentario/{id}','Mudanza\ComentarioController@eliminar_comentario');
	 });
	//********************************Documentos***************************************************
	Route::get('busqueda_documento/{id}','Mudanza\DocumentosController@busqueda_documentos');
	Route::post('insertar_documento','Mudanza\DocumentosController@insertar_documentos');
	Route::post('eliminar_documento/{id}','Mudanza\DocumentosController@eliminar_documentos');
    Route::post('actualizar_documento/{id}','Mudanza\DocumentosController@actualizar_documentos');


     /********************************PRESTADOR SERVICIO ************************************************ */
     Route::group(['prefix'=>'prestador_servicio'],function(){
        Route::post('insertar','Mudanza\PrestadorServicioController@insertar');
        Route::get('ultimo','Mudanza\PrestadorServicioController@ultimo_registro');
        Route::get('buscar/{correo}','Mudanza\PrestadorServicioController@buscar_correo');
        Route::get('horario_tarifa/{horainicio}','Mudanza\PrestadorServicioController@verprestadorporhora');
        Route::get('horario_tarifa/{agregarServiciosExtras}','Mudanza\PrestadorServicioController@verprestadorporhora');
        Route::get('busquedaprestador_id/{id}','Mudanza\PrestadorServicioController@busquedaPrestadorServicio_id');
     });

     //********************************* Servicios Extras ******************************************************************* */

     Route::group(['prefix'=>'Servicios_Extras'],function(){
         Route::post('insertar_Servicios_Extras','Mudanza\ServiciosExtrasController@insertar_servicios_extras');
         Route::get('mostrar_Servicios_Extras_Xid_Prestador/{id}','Mudanza\ServiciosExtrasController@mostrar_servicios_Extras_XidPrestador');
         Route::post('actualizar_Servicios_Extras/','Mudanza\ServiciosExtrasController@actualizar_servicios_extras');
     });
      /**********************************VEHICULO ************************************************ */
      Route::group(['prefix'=>'vehiculo'],function(){
        Route::post('insertar','Mudanza\VehiculoController@insertar');
        Route::get('listar','Mudanza\VehiculoController@listar_vehiculos');
     });

     /**********************************DOCUMENTOS***************************************************** */

     Route::group(['prefix'=>'documentos'],function(){
        Route::post('insertar','Mudanza\DocumentosController@insertar_documentos');
        Route::get('listar','Mudanza\DocumentosController@listar_documentos');
     });

});
