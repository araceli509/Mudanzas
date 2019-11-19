<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
  function insertar(Request $request){

        $id_prestador=$request->id_prestador;
        $modelo=$request->modelo;
        $placas=$request->placas;
        $capacidad_carga=$request->capacidad_carga;
        $foto_frontal=$request->foto_frontal;
        $foto_lateral=$request->foto_lateral;
        $foto_trasera=$request->foto_trasera;
        Vehiculo::create([
            'id_prestador' => $id_prestador,
            'modelo' => $modelo,
            'placas' => $placas,
            'capacidad_carga' => $capacidad_carga,
            'foto_frontal' => $foto_frontal,
            'foto_lateral' => $foto_lateral,
            'foto_trasera' => $foto_trasera
        ]);

  }

  public function listar_vehiculos(){
    $vehiculo=Vehiculo::all();
    return response()->json(['Vehiculo'=>$vehiculo]);
  }

  function listarMiVehiculo(Request $request){

    $id=$request->input('id_prestador');
	$consulta= Vehiculo::where('id_prestador',$id)->take(1)->first();
		if (empty($consulta)) {
			return 'error no encontrado';
		} else {

			return response()->json(['mivehiculo'=>$mivehiculo]);
		}
  }

}
