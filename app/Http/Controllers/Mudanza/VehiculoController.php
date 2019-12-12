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
        $largo=$request->largo;
        $ancho=$request->ancho;
        $alto=$request->alto;
        $foto_frontal=$request->foto_frontal;
        $foto_lateral=$request->foto_lateral;
        $foto_trasera=$request->foto_trasera;
        Vehiculo::create([
            'id_prestador' => $id_prestador,
            'modelo' => $modelo,
            'placas' => $placas,
            'largo' => $largo,
            'ancho'=>$ancho,
            'alto'=>$alto,
            'foto_frontal' => $foto_frontal,
            'foto_lateral' => $foto_lateral,
            'foto_trasera' => $foto_trasera
        ]);

  }

  public function listar_vehiculos(){
    $vehiculo=Vehiculo::all();
    return response()->json(['Vehiculo'=>$vehiculo]);
  }


}
