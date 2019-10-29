<?php

namespace App\Http\Controllers\Mudanza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentos;
use GuzzleHttp\Client;
use Illumninate\Support\Facades\DB;
class DocumentosController extends Controller
{   
	//funcion que busca un documento
	public function busqueda_documentos(Request $request){
		 $id=$request->id;
         if(Documentos::find($id)){
             return response()->json($id=Documentos::select('licencia_vigente','tarjeta_circulacion','ine')
                 ->where('id_documentos','=',$id)
                 ->get());
         }else{
            return response()->json(['Mensaje'=>'El registro no se encuentra',]);
         }
		
	}

	//api que busca un documento recibe como parametro el id del documento a buscar
	 public function busqueda_documentos_api($dato){
        $respuesta=$this->peticion('GET',"http://mudanzasito.000webhostapp.com/api/auth/busqueda_documento/{$dato}");
        $datos2=json_decode($respuesta);
        return response()->json($datos2);
    }   

   /* public function insertar_documentos(Request $request){

       if ($request->hasFile('tarjeta_circulacion')) {
            $imagen=$request->file('tarjeta_circulacion');
            $nombre_imagen=time().$imagen->getClientOriginalName();
            $imagen->move(public_path().'/uploads/',$nombre_imagen);
        }
        if ($request->hasFile('licencia_vigente')) {
            $imagen1=$request->file('licencia_vigente');
            $nombre_imagen1=time().$imagen1->getClientOriginalName();
            $imagen1->move(public_path().'/uploads/',$nombre_imagen1);
        }
        if ($request->hasFile('ine')) {
            $imagen2=$request->file('ine');
            $nombre_imagen2=time().$imagen2->getClientOriginalName();
            $imagen2->move(public_path().'/uploads/',$nombre_imagen2);
        }
		
		 Documentos::create([
            'tarjeta_circulacion' => $nombre_imagen,
            'licencia_vigente' => $nombre_imagen1,
            'ine' =>  $nombre_imagen2,
        ]);
        return "agregado correctamente";
    }

    public function vista_insertar_documentos(){
    	return view('insertar_documentos');
    }*/

    //funcion que inserta un documento
    public function insertar_documentos(Request $request){
        $licencia_vigente=$request->licencia_vigente;
        $tarjeta_circulacion=$request->tarjeta_circulacion;
        $ine=$request->ine;
        Documentos::create([
            'tarjeta_circulacion' => $tarjeta_circulacion,
            'licencia_vigente' => $licencia_vigente,
            'ine' =>  $ine,
        ]);

         return response()->json(['Mensaje'=>'Registrado Correctamente',]);
    }

    //api que inserta los valores en la tabla documentos recbine como parametros los valores a insertar en la tabla
    public function insertar_documentos_api(Request $request){
        $licencia_vigente=$request->licencia_vigente;
        $tarjeta_circulacion=$request->tarjeta_circulacion;
        $ine=$request->ine;
        $respuesta=$this->peticion('POST',"http://mudanzasito.000webhostapp.com/api/auth/insertar_documento",
            ['headers'=>[
                'Content-Type'=> 'application/x-www-form-urlencoded',
                'X-Requested-With' => 'XMLHttpRequest'
            ],
            'form_params' => [
                'tarjeta_circulacion' => $tarjeta_circulacion,
                'licencia_vigente' => $licencia_vigente,
                'ine'=>$ine
            ]
        ]);

        $datos = json_decode($respuesta);
        return response()->json($datos);
    }

    //funcion que elimina un documento en base al id recibido como parametro
    public function eliminar_documentos(Request $request){
        $id=$request->id;
        if(Documentos::find($id)){
             $eliminar=Documentos::select('id_documentos')
            ->where('id_documentos','=',$id)
            ->delete();

            return response()->json(['Mensaje'=>'Eliminado Correctamente',]);
        }else{
             return response()->json(['Mensaje'=>'El registro que desea eliminar no se encuentra',]);
        }
       
    }

    //api que elimina un documento
    public function eliminar_documentos_api($dato){
         $respuesta=$this->peticion('POST',"http://mudanzasito.000webhostapp.com/api/auth/eliminar_documento/{$dato}");
        $datos=json_decode($respuesta);
        return response()->json($datos);
    }

    //funcion que actualiza el documento
    public function actualizar_documentos(Request $request){
        $id=$request->id;
        if(Documentos::find($id)){
            $tarjeta_circulacion=$request->tarjeta_circulacion;
            $licencia_vigente=$request->licencia_vigente;
            $ine=$request->ine;
            $actualizar=Documentos::select('tarjeta_circulacion','licencia_vigente','ine')
            ->where('id_documentos','=',$id)
            ->update(['tarjeta_circulacion'=>$tarjeta_circulacion,'licencia_vigente'=>$licencia_vigente,'ine'=>$ine]);
            return response()->json(['Mensaje'=>'Actualizado Correctamente']);
        }else{
            return response()->json(['Mensaje'=>'El registro que desea actualizar no se encuentra',]);
        }
    }

    //api que actualiza un documento en base a los parametros recibidos por get
    public function actualizar_documentos_api(Request $request){
        $dato=$request->id_documentos;
        $licencia_vigente=$request->licencia_vigente;
        $tarjeta_circulacion=$request->tarjeta_circulacion;
        $ine=$request->ine;
        $respuesta=$this->peticion('POST',"http://mudanzasito.000webhostapp.com/api/auth/actualizar_documento/{$dato}",
            ['headers'=>[
                'Content-Type'=> 'application/x-www-form-urlencoded',
                'X-Requested-With' => 'XMLHttpRequest'
            ],
            'form_params' => [
                'tarjeta_circulacion' => $tarjeta_circulacion,
                'licencia_vigente' => $licencia_vigente,
                'ine'=>$ine
            ]
        ]);

        $datos = json_decode($respuesta);
        return response()->json($datos);
    }

    //funcion que lista todos los documentos existentes y los devuelve en un json
    public function listar_documentos(){
        $documentos=Documentos::all();
        return $documentos;
    }
    
    	
}
