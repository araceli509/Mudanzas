<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\Reservacion;
use Illuminate\Support\Facades\Validator;

class ReservacionController extends Controller
{

//Metodo que devuelve una lista de reservaciones registrados
    public function listarreservaciones(){
         return response()->json(Reservacion::select('id_cliente','id_prestador','fecha_hora','origen','destino','origenLatLong','destinoLatLong','distancia','seguro','numero_pisos','monto')
         ->where('status', '=','1')
        ->get());
    }

    //Metodo que busca un reservacion por medio de su id
	public function busquedareservacion_id(Request $request){
		 $id=$request->id;
		 return response()->json($id=Reservacion::select('id_cliente','id_prestador','fecha_hora','origen','destino','origenLatLong','destinoLatLong','distancia','seguro','numero_pisos','monto')
        ->where('id_reservacion','=',$id)
        ->where('status', '=','1')
        ->get());
    }

    public function buscar_reservacion(Request $request){
        $id=$request->id;
        return response()->json(['reservaciones'=>$id=Reservacion::select('id_cliente','id_prestador','fecha_hora','origen','destino','origenLatLong','destinoLatLong','distancia','seguro','numero_pisos','monto','status')
        ->where('id_cliente','=',$id)
        ->get()]);
    }

    public function reservaciones($id){

      $reservaciones= Reservacion::with('Cliente')->where('id_prestador','=',$id)
        ->where('status', '=','1')
        ->get();

      $data= $reservaciones->toArray();
    // return $data;
    return response(["reservaciones"=>$data]);

    }

    public function buscarreservacionporusuario($ide){
        return response()->json(['reservacion'=>$id=Reservacion::select('fecha_hora','origen','destino','monto','status')
        ->where('id_cliente','=',$ide)
        ->where('status', '=','1')
        ->get()]);
    }

    public function FunctionName($value='')
    {
      // code...
    }

    //Metodo que crea un reservacion nuevo
   public function agregar_reservacion(Request $request){
    $request->validate([
            'id_cliente'=> ['required'],
            'id_prestador'=> ['required'],
            'fecha_hora'=> ['required'],
            'origen'=> ['required', 'string'],
            'destino'=> ['required', 'string'],
            'origenLatLong' => ['required', 'string'],
            'destinoLatLong'=> ['required', 'string'],
            'distancia'=> ['required'],
            'seguro'=> ['required'],
            'numero_pisos'=> ['required', 'integer'],
        ]);
        $reservacion = Reservacion::create([
            'id_cliente' => $request['id_cliente'],
            'id_prestador' => $request['id_prestador'],
            'fecha_hora' => $request['fecha_hora'],
            'origen' => $request['origen'],
            'destino' => $request['destino'],
            'origenLatLong' => $request['origenLatLong'],
            'destinoLatLong' => $request['destinoLatLong'],
            'distancia' => $request['distancia'],
            'seguro' => $request['seguro'],
            'numero_pisos' => $request['numero_pisos'],
            'monto' => $request['monto'],
            'status'=>'1',
        ]);

        return response()->json(['Exito'=>'Registrado correctamente']);
    }


    //metodo que actualiza la informacion de la reservacion
    public function actualizar_reservacion(Reservacion $reservacion,Request $request){
        $request->validate([
            'origen'=> ['string'],
            'destino'=> ['string'],
            'origenLatLong' => ['string'],
            'destinoLatLong'=> ['string'],
            'numero_pisos'=> ['integer'],
            'status'=> ['integer'],
        ]);
        $reservacion->fill($request->all());
        $reservacion ->save();
        return response()->json(['Exito'=>'Actualizado correctamente']);
    }

    //Metodo para eliminar una reservacion
    public function eliminar_reservacion(Request $request,$id){
        $editar = Reservacion::find($id);
        $editar->status = '0';
        $editar->update();
        return response()->json(['Exito'=>'Eliminado correctamente']);
       }

       public function aceptar_reservacion($id){
           $editar = Reservacion::find($id);
           $editar->status = '2';
           $editar->update();
           return response()->json(['Exito'=>'Aceptado correctamente']);
          }
}
