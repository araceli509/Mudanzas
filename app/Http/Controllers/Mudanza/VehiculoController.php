<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
  function insertarVehiculo(Request $request){
    $request->validate([
            'id_vehiculo'=> ['required', 'int'],
            'id_prestador'=> ['required', 'int'],
            'modelo' => ['required', 'string'],
            'placas'=> ['required', 'string',],
            'capacidadCarga'=> ['required', 'string'],
            'foto_frontal'=> ['required', 'string'],
            'foto_lateral'=>['required','string'],
            'foto_trasera'=>['required','string'],

        ]);

        $mudanza = Vehiculo::create([
            'id_cliente' => $request['id_cliente'],
            'id_prestador' => $request['id_prestador'],
            'modelo' => $request['origen'],
            'placas' => $request['origen'],
            'capacidadCarga' => $request['distancia'],
            'foto_frontal' => $request['fecha_registro'],
            'foto_lateral' => $request['fecha_registro'],
            'foto_trasera' => $request['fecha_registro']
        ]);
      return response()->json(['Exito'=>'Vehiculo creado']);

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
