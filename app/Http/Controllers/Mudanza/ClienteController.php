<?php

namespace App\Http\Controllers\Mudanza;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\Cliente;
use App\Models\PrestadorServicio;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{

//Metodo que devuelve una lista de clientes registrados
    public function listarclientes(){
         return response()->json(Cliente::select('id_cliente','nombre','apellidos','correo','direccion','telefono','codigo_postal','fecha_registro')
         ->where('status', '=','1')
        ->get());
    }

    //Metodo que busca un cliente por medio de su id
	public function busquedacliente_id(Request $request){
		 $id=$request->id;
		 return response()->json($id=Cliente::select('nombre','apellidos','correo','direccion','telefono','codigo_postal','fecha_registro')
        ->where('id_cliente','=',$id)
        ->where('status', '=','1')
        ->get());
    }

    //Metodo que busca un cliente por medio de su correo
	public function busquedacliente_correo($correo){
        return response()->json(['cliente'=>$id=Cliente::select('id_cliente')
       ->where('correo','=',$correo)
       ->where('status', '=','1')
       ->get()]);
   }
   public function busquedacliente_correo_reservacion($correo){
$prestador=Cliente::join('reservacion','cliente.id_cliente','=','reservacion.id_cliente')
        ->select('reservacion.fecha_hora','reservacion.origen','reservacion.destino','reservacion.monto','reservacion.status')
        ->where('cliente.correo','=',$correo)
        ->where('reservacion.status', '!=','0')
        ->get();
        return response()->json(['reservacion'=>$prestador]);
}

   public function busquedaPrestador($correo){
         return response()->json(['prestador'=>$id=PrestadorServicio::select('id_prestador')
        ->where('correo','=',$correo)
        ->where('status', '=','1')
        ->get()]);
    }


   public function agregar_cliente(Request $request){
    $request->validate([
            'nombre'=> ['required', 'string', 'max:50','unique:cliente'],
            'apellidos'=> ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:255', 'unique:cliente'],
            'direccion'=> ['required', 'string', 'max:200'],
            'telefono'=> ['required', 'string', 'max:20','unique:cliente'],
            'codigo_postal'=> ['required', 'string', 'max:10'],
            'fecha_registro'=> ['required', 'date_format:Y/m/d'],
        ]);
        //$cliente = Cliente::create($request->all());
        $cliente = Cliente::create([
            'nombre' => $request['nombre'],
            'apellidos' => $request['apellidos'],
            'correo' => $request['correo'],
            'direccion' => $request['direccion'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'codigo_postal' => $request['codigo_postal'],
            'fecha_registro' => $request['fecha_registro'],
            'status'=>'1',
        ]);
        return response()->json(['Exito'=>'Registrado correctamente']);
    }

    //metodo que actualiza la informacion del cliente
    public function actualizar_cliente(Cliente $cliente,Request $request){
        $request->validate([
            'nombre'=> ['string', 'max:50',Rule::unique('cliente')->ignore($cliente)],
            'apellidos'=> ['string', 'max:100'],
            'correo' => ['email', 'max:255', Rule::unique('cliente')->ignore($cliente)],
            'direccion'=> ['string', 'max:200'],
            'telefono'=> ['string', 'max:20',Rule::unique('cliente')->ignore($cliente)],
            'codigo_postal'=> [ 'string', 'max:10'],
            'fecha_registro'=> ['date_format:Y/m/d'],
        ]);
        $cliente->fill($request->all());
        $cliente ->save();
        return response()->json(['Exito'=>'Actualizado correctamente']);

    }

    //Metodo para eliminar un cliente
    public function eliminar_cliente(Request $request,$id){
        $editar = Cliente::find($id);
        $editar->status = '0';
        $editar->update();
        return response()->json(['Exito'=>'Eliminado correctamente']);
       }
}

//prueba
