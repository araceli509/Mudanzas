<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\mudanzas;
use Illuminate\Support\Facades\Validator;

class MudanzasController extends Controller
{
  function insertarMudanza(Request $request){
    $request->validate([
            'id_cliente'=> ['required', 'int'],
            'id_prestador'=> ['required', 'int'],
            'origen' => ['required', 'string'],
            'destino'=> ['required', 'string',],
            'distancia'=> ['required', 'string'],
            'fecha_registro'=> ['required', 'date_format:Y/m/d'],
        ]);

        $mudanza = mudanzas::create([
            'id_cliente' => $request['id_cliente'],
            'id_prestador' => $request['id_prestador'],
            'origen' => $request['origen'],
            'destino' => $request['origen'],
            'distancia' => $request['distancia'],
            'fecha_registro' => $request['fecha_registro']
        ]);
      return response()->json(['Exito'=>'Mudanza establecida']);

  }

  function listarMisMudanzas(Request $request){
    $mismudanzas= mudanzas::select('id_mudanza','id_cliente','id_prestador','origen','destino','tiempo','fecha_mudanza')->where('id_cliente',$request->id_cliente)->get();
    return $mismudanzas;

  }
  function listarMisServicios(Request $request){
    $misservicios= mudanzas::select('id_mudanza','id_cliente','id_prestador','origen','destino','tiempo','fecha_mudanza')->where('id_prestador',$request->id_prestador)->get();
    return $misservicios;


  }


}
