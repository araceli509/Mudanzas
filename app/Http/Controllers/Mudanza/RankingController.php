<?php

namespace App\Http\Controllers\Mudanza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ranking;
use GuzzleHttp\Client;
use Illumninate\Support\Facades\DB;
class RankingController extends Controller
{   
	public function busqueda_id_ranking(Request $request){
		 $id=$request->id;
		 return response()->json($id=Ranking::select('id_ranking',
		 	'id_prestador','valoracion')
        ->where('id_ranking','=',$id)
        ->get());
	}

	 public function busqueda_ranking($dato){
        $respuesta=$this->peticion('GET',"http://mudanzasito.000webhostapp.com/api/auth/busqueda_id_ranking/{$dato}");
        $datos=json_decode($respuesta);
        return response()->json($datos);
    }  
    
    	
}
