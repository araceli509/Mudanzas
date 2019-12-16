<?php

namespace App\Http\Controllers\Mudanza;


use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ubicacionprestador;

use Illuminate\Support\Facades\Validator;

class UbicacionPrestadorController extends Controller
{

  function insertarubicacion(Request $request)
  {
  $ubicacion = Ubicacionprestador::create([
        'id_prestador' => $request['id_prestador'],
        'id_cliente' => $request['id_cliente'],
        'uid_prestador'=>$request['uid_prestador']
    ]);
    if($ubicacion!=null){
      return response()->json(['Exito'=>'Mudanza establecida']);
  }else{

    return response()->json(['Error'=>'No se pudo insertar']);
  }
}

  function eliminaruid(Request $request)
  {
    $ubicacion= Ubicacionprestador::Select()->where('id_prestador','=',$request->id_prestador)->where('id_cliente','=',$request->id_cliente)->get();
    $ubicacion->delete();
  }

  public function buscaruid(Request $request)
  {
    $ubicacion =Ubicacionprestador::Select("id_prestador","uid_prestador","id_cliente")->where('id_prestador','=',$request->id_prestador)->where('id_cliente','=',$request->id_cliente)->get();
    return  response()->json(['uid'=>$ubicacion]);
  }
}
