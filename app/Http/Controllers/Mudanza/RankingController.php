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
    
    public function agregar_rankin(Request $request){
            $request->validate([
                'id_prestador'=> ['required'],
                'valoracion'=> ['required']
            ]);
            $cliente = Ranking::create([
                'id_prestador' => $request['id_prestador'],
                'valoracion' => $request['valoracion']
            ]);
            return response()->json(['Exito'=>'Registrado correctamente']);
        }
    
    	
}
