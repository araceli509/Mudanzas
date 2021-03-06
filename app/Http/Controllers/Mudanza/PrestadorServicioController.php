<?php

namespace App\Http\Controllers\Mudanza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentos;
use App\Models\PrestadorServicio;
use App\Models\Vehiculo;
use Mail;
use Session;
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
		->where('solicitud','=','0')
		->where('status','=','0')
		->get()]);
	}

	public function correo_activo(Request $request){
		$correo=$request->correo;
		$prestador=PrestadorServicio::select('id_prestador','status','solicitud')
		->where('correo','=',$correo)
		->get();
		return response()->json(['Prestador'=>$prestador]);
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

	public function prestadores_activos(){
		$prestador=PrestadorServicio::select('id_prestador','nombre','apellidos','direccion','telefono','correo')
		->where('solicitud','=','1')
		->where('status','=','1')
		->get();

		return view('admin.prestadores_activos')->with('prestador',$prestador);
	}

	public function ver_detalles_prestador_pendiente($id){
		$prestador=PrestadorServicio::find($id);
		$documentos=Documentos::select('ine','tarjeta_circulacion','licencia_vigente')
		->where('id_prestador','=',$id)->get();

		$vehiculos=Vehiculo::select('foto_frontal','foto_lateral','foto_trasera')
		->where('id_prestador','=',$id)->get();
		
		return view('admin.detalles_prestador_pendiente')->with('prestador',$prestador)
		->with('documentos',$documentos)
		->with('vehiculo',$vehiculos);
	}

	public function aprobar_prestador(Request $request,$id){
		$prestador= PrestadorServicio::find($id);
		$correo_user=$prestador->correo;

		Mail::send('mail.entrenamientoWeb', ['user' => $prestador->nombre], function ($m) use ($prestador) {
            $m->from('mudanzas.ito2019@gmail.com', 'Mudanzito :D');
			//$m->to('ricardo.oax@gmail.com', 'Ricardo baños')->subject('Recordatorio');
			$m->to($prestador->correo, $prestador->nombre)->subject('Recordatorio');
        });
		$prestador=PrestadorServicio::where('id_prestador',$id)
		->update([
			'status'=>'1',
			'solicitud'=>'1'

		]);
		
		return redirect()->to('prestador/pendientes');
	}

	public function ver_detalle_prestador($id){
		$prestador=PrestadorServicio::join('vehiculo','prestador_servicio.id_prestador','=','vehiculo.id_prestador')
		->select('ine','licencia_conducir','tarjeta_vigente')->get();
	}


	public function verprestadorporhora($horainicio){
		$prestador = PrestadorServicio::join('horario_tarifa','prestador_servicio.id_prestador','=','horario_tarifa.id_prestador')
		->join('vehiculos2','prestador_servicio.id_prestador','=','vehiculos2.id_prestador')
		->join('ranking','prestador_servicio.id_prestador','=','ranking.id_prestador')
		->select('prestador_servicio.id_prestador','prestador_servicio.nombre','vehiculos2.largo','vehiculos2.ancho','vehiculos2.alto','horario_tarifa.precio','ranking.valoracion')
		->where('prestador_servicio.status', '=','1')
		->where('prestador_servicio.solicitud', '=','1')
		->WhereRaw('? BETWEEN horario_tarifa.hora_inicio and horario_tarifa.hora_salida',$horainicio)
        ->get();
		  return response()->json(['prestador'=>$prestador]);
	}

	//Metodo que busca un Prestador por medio de su id
	public function busquedaPrestadorServicio_id($id){
		$prestador = PrestadorServicio::join('ranking','prestador_servicio.id_prestador','=','ranking.id_prestador')
		->join('horario_tarifa','prestador_servicio.id_prestador','=','horario_tarifa.id_prestador')
		->join('vehiculos2','prestador_servicio.id_prestador','=','vehiculos2.id_prestador')
		->select('prestador_servicio.nombre','prestador_servicio.apellidos','prestador_servicio.direccion','prestador_servicio.telefono','prestador_servicio.correo','prestador_servicio.codigo_postal','prestador_servicio.foto_perfil','ranking.valoracion','horario_tarifa.precio','horario_tarifa.hora_inicio','horario_tarifa.hora_salida','vehiculos2.foto_frontal','vehiculos2.foto_lateral','vehiculos2.foto_trasera','vehiculos2.largo','vehiculos2.ancho','vehiculos2.alto','vehiculos2.placas')
		->where('prestador_servicio.id_prestador','=',$id)
	   ->where('prestador_servicio.status', '=','1')
        ->get();
		  return response()->json(['prestador'=>$prestador]);
   }
}
