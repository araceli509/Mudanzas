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
	
	public function buscar_correo($correo){
		$prestador=PrestadorServicio::find($correo);
		return response()->json(['Prestador'=>$prestador]);
	}
}
