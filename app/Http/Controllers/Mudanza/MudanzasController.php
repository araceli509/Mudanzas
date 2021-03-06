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
            'fecha_mudanza'=> ['required', 'date_format:Y/m/d'],
            'hora'=>['required','string'],

        ]);

        $mudanza = mudanzas::create([
            'id_cliente' => $request['id_cliente'],
            'id_prestador' => $request['id_prestador'],
            'origen' => $request['origen'],
            'destino' => $request['origen'],
            'distancia' => $request['distancia'],
            'tiempo'=>$request['tiempo'],
            'fecha_mudanza' => $request['fecha_mudanza'],
            'hora'=>$request['hora'],
            'status'=>1
        ]);
      return response()->json(['Exito'=>'Mudanza establecida']);

  }

  function listarMisMudanzas($id){
    $mudanzas= Mudanzas::With('cliente')->where('id_prestador',$id)->where('status','=','2')->get();

    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);
  }

  public function misMudanzasenEspera($id)
  {
    $mudanzas= Mudanzas::With('cliente')->where('id_prestador',$id)->where('status','=','1')->get();

    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);
  }
  public function miMudanzaActiva($id)
  {
    $mudanzas= Mudanzas::With('cliente')->where('id_prestador',$id)->where('status','=','3')->get();
    $data= $mudanzas->toArray();
    return response(["mudanzas"=>$data]);
  }

  public function mismudanzasenesperacliente($id){
    $mudanzas= Mudanzas::With('prestador')->where('id_cliente',$id)->where('status','=','1')->get();

    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);
  }
  public function mismudanzashechasCliente($id){
    $mudanzas= Mudanzas::With('prestador')->where('id_cliente',$id)->where('status','=','2')->get();
    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);
  }
  public function mismudanzasactivasCliente($id){
    $mudanzas= Mudanzas::With('prestador')->where('id_cliente',$id)->where('status','=','3')->get();

    $data= $mudanzas->toArray();
  // return $data;
  return response(["mudanzas"=>$data]);
  }

  public function cambiarestado(Request $request)
  {
    $mimudanza= Mudanzas::find($request->id_mudanza);
    $mimudanza->status=$request->status;
    $mimudanza->save();
    return response(['Exito'=>'Mudanza establecida']);
  }

    public function listarMisServicios($id_prestador){
    $misservicios= Mudanzas::select('id_mudanza','id_cliente','id_prestador','origen','destino','tiempo','fecha_mudanza','hora','status')->where('id_prestador','=',$id_prestador)->get();
    return $misservicios;

  }


}
