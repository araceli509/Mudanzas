<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comentario;
use GuzzleHttp\Client;
use Illumninate\Support\Facades\DB;
class ComentarioController extends Controller
{
	 
    
    	public function busqueda_id_comentario(Request $request){
		 $id=$request->id;
		 return response()->json($id=Comentario::select('id_comentario','descripcion','fecha_comentario',
		 'id_cliente','id_prestador')
        ->where('id_comentario','=',$id)
        ->get());
	}

	 public function busqueda_comentario($dato){
        $respuesta=$this->peticion('GET',"http://mudanzasito.000webhostapp.com/api/auth/busqueda_id_comentario/{$dato}");
        $datos=json_decode($respuesta);
        return response()->json($datos);
    } 
    
    //Metodo que devuelve una lista de los comentarios registrados 
    public function listarcomentarios(){
         return response()->json(Comentario::select('descripcion','fecha_comentario',
		 'id_cliente','id_prestador')
         ->where('status', '=','1')
        ->get());
    }

    //Metodo que busca un comentario por medio de su id
	public function busquedacomentario_id(Request $request){
		 $id=$request->id;
		 return response()->json($id=Comentario::select('descripcion','fecha_comentario',
		 'id_cliente','id_prestador')
        ->where('id_comentario','=',$id)
        ->where('status', '=','1')
        ->get());
    }

     //Metodo que busca un comentario por medio de su id
	public function busquedacomentario_idprestador(Request $request){
        $id=$request->id;
        $prestador = Comentario::join('cliente','cliente.id_cliente','=','comentario.id_cliente')->select('cliente.nombre','comentario.descripcion','comentario.fecha_comentario')
		->where('comentario.id_prestador','=',$id)
	   ->where('comentario.status', '=','1')
        ->get();
		  return response()->json(['comentario'=>$prestador]);
   }
   
    
    //Metodo que crea un nuevo comentario
   public function agregar_comentario(Request $request){
    $request->validate([
            'descripcion'=> ['required','string','max:200'],
            'fecha_comentario' => ['required', 'date_format:Y/m/d'],
            'id_cliente'=>['required','int','max:11'],
            'id_prestador'=>['required','int','max:11'],
            //'id_comentario'=>['required','int','max:11'],
         
        ]);
         $comentario = Comentario::create([ 
             'descripcion' => $request['descripcion'],
            'fecha_comentario' => $request['fecha_comentario'],
            'id_cliente'=> $request['id_cliente'],
            'status'=> '1',
            'id_prestador'=> $request['id_prestador'],
            
        ]);
    
        return response()->json(['Exito'=>'Registrado correctamente']);
    }
    
    //metodo que actualiza la informacion del comentario
    public function actualizar_comentario(Comentario $comentario,Request $request){
        $request->validate([
            'descripcion'=> ['string', 'max:200'],
            'fecha_comentario'=> ['date_format:Y/m/d'],
            'id_cliente' => ['int', 'max:11'],
           'id_prestador'=> ['int', 'max:11'],
        
        ]);
        $comentario->fill($request->all());
        $comentario->save();
        return response()->json(['Exito'=>'Actualizado correctamente']); 
        
    }

    //Metodo para eliminar un comentario 
    public function eliminar_comentario(Request $request,$id){
        $editar = Comentario::find($id);
        $editar->status = '0';
        $editar->update();
        return response()->json(['Exito'=>'Eliminado correctamente']); 
       }
    
    
}
