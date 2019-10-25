<?php

namespace App\Http\Controllers\Mudanza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\Documentos;
class DocumentosController extends Controller
{
	public function busqueda_id(Request $request){
		 $id=$request->id;
		 return response()->json($id=Documentos::select('licencia_vigente','tarjeta_circulacion','ine')
        ->where('id_documentos','=',$id)
        ->get());
	}

	 public function busqueda_documento($dato){
        $respuesta=$this->peticion('GET',"http://mudanzasito.000webhostapp.com/api/auth/busqueda_id/{$dato}");
        $datos=json_decode($respuesta);
        return response()->json($datos);
    }   
}
