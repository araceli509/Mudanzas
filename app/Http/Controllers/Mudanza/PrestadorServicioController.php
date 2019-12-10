<?php

namespace App\Http\Controllers\Mudanza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrestadorServicio;
class PrestadorServicioController extends Controller
{
    public function insertar(Request $request){
    	$nombre=$request->nombre;
    	$apellidos=$request->apellidos;
    	$direccion=$request->direccion;
    	$telefono=$request->telefono;
    	$correo=$request->correo;
    	$codigo_postal=$request->codigo_postal;
        $foto_perfil=$request->foto_perfil;
    	$status='0';
    	$solicitud='0';
    	PrestadorServicio::create(['nombre'=>$nombre,'apellidos'=>$apellidos,'direccion'=>$direccion,
    	'telefono'=>$telefono,'correo'=>$correo,'codigo_postal'=>$codigo_postal,'status'=>$status,'solicitud'=>
    	$solicitud,'foto_perfil'=>$foto_perfil]);
    }

    public function ultimo_registro(){
        $prestador=PrestadorServicio::all();
		return response()->json(['Prestador'=>$prestador]);
	}
	
	public function buscar_correo(Request $request){
		$correo=$request->correo;
		return response()->json(['Prestador'=>$prestador=PrestadorServicio::select('id_prestador')
		->where('correo','=',$correo)
		->where('solicitud','=','1')
		->where('status','=','1')
		->get()]);
	}

	public function dashboard(){
		return view('admin.dashboard');
	}

	public function prestadores_pendientes(){
		$prestador=PrestadorServicio::select('id_prestador','nombre','apellidos','direccion','telefono','correo')
		->where('solicitud','=','0')
		->where('status','=','0')
		->get();
		return view('admin.prestadores_pendientes')->with('prestador',$prestador);
	}

	public function ver_detalles_prestador_pendiente($id){
		$prestador=PrestadorServicio::find($id);
		return view('admin.detalles_prestador_pendiente')->with('prestador',$prestador);
	}


	public function verprestadorporhora($horainicio){
		$prestador = PrestadorServicio::join('horario_tarifa','prestador_servicio.id_prestador','=','horario_tarifa.id_prestador')
		->join('vehiculos2','prestador_servicio.id_prestador','=','vehiculos2.id_prestador')
		->join('ranking','prestador_servicio.id_prestador','=','ranking.id_prestador')
		->select('prestador_servicio.id_prestador','prestador_servicio.nombre','vehiculos2.capacidad_carga','horario_tarifa.precio','ranking.valoracion')
		->WhereRaw('? BETWEEN horario_tarifa.hora_inicio and horario_tarifa.hora_salida',$horainicio)
        ->get();
		  return response()->json(['prestador'=>$prestador]);
	}

	//Metodo que busca un Prestador por medio de su id
	public function busquedaPrestadorServicio_id($id){
		$prestador = PrestadorServicio::join('ranking','prestador_servicio.id_prestador','=','ranking.id_prestador')
		->join('horario_tarifa','prestador_servicio.id_prestador','=','horario_tarifa.id_prestador')
		->select('prestador_servicio.nombre','prestador_servicio.apellidos','prestador_servicio.direccion','prestador_servicio.telefono','prestador_servicio.correo','prestador_servicio.codigo_postal','prestador_servicio.foto_perfil','ranking.valoracion','horario_tarifa.precio')
		->where('prestador_servicio.id_prestador','=',$id)
	   ->where('prestador_servicio.status', '=','1')
        ->get();
		  return response()->json(['prestador'=>$prestador]);
   }
}
