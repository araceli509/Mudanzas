<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\Mudanzas;
use App\Models\PrestadorServicio;
use App\Models\Cliente;
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

  function listarMisMudanzas($id){
    $mudanzas= PrestadorServicio::With('misMudanzas')->where('id_prestador',$id)->where('status','=','1')->get();

    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);
  }

  public function mismudanzasCliente($id){
    $mudanzas= Cliente::With('mudanzas')->where('id_cliente',$id)->where('status','=','1')->get();

    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);

  }

    public function listarMisServicios($id_prestador){
    $misservicios= Mudanzas::select('id_mudanza','id_cliente','id_prestador','origen','destino','tiempo','fecha_mudanza','hora','status')->where('id_prestador','=',$id_prestador)->get();
    return $misservicios;

  }


}
