<?php

namespace App\Http\Controllers\Mudanza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentos;

class DocumentosController extends Controller
{   
    //funcion que inserta un documento
    public function insertar_documentos(Request $request){
        $id_prestador=$request->id_prestador;
        $ine=$request->ine;
        $licencia_vigente=$request->licencia_vigente;
        $tarjeta_circulacion=$request->tarjeta_circulacion;
       
        Documentos::create([
            'id_prestador'=>$id_prestador,
            'ine'=>$ine,
            'licencia_vigente' => $licencia_vigente,
            'tarjeta_circulacion' => $tarjeta_circulacion
        ]);
    }

    

    public function listar_documentos(){
        $documentos=Documentos::all();
        return response()->json(['Documentos'=>$documentos]);
    }
    
    	
}
