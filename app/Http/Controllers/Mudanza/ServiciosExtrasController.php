<?php

namespace App\Http\Controllers\Mudanza;

use App\Models\PrestadorServicio;
use App\Models\Horario_Tarifa;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ServiciosExtrasController extends Controller
{
    
    public function mostrar_servicios_Extras_XidPrestador(Request $request){
        $id=$request->id;
        return response()->json(['servicios_extras'=>$id=Horario_Tarifa::select('dias','hora_inicio','hora_salida','costoXcargador','costoUnitarioCajaG','costoUnitarioCajaM','costoUnitarioCajaC','precio')
        ->where('id_prestador','=',$id)
        ->get()]);
        

    }
    public function insertar_servicios_extras(Request $request){
        $seviciosExtra= Horario_Tarifa::create([
            'id_prestador'=>$request['id_prestador'],
            'dias'=> $request['dias'],
            'hora_inicio'=> $request['hora_inicio'],
            'hora_salida'=> $request['hora_salida'],
            'costoXcargador'=> $request['costoXcargador'],
            'costoUnitarioCajaG'=> $request['costoUnitarioCajaG'],
            'costoUnitarioCajaM'=> $request['costoUnitarioCajaM'],
            'costoUnitarioCajaC'=> $request['costoUnitarioCajaC'],
            'precio'=> $request['precio']
        ]);
        return response()->json(['a huevo'=>'Si salio']);
    }
    

   /*public function actualizar_servicios_extras( Hora_Tarifa $seviciosExtra,Request $request ){
       //$seviciosExtra= Horario_Tarifa::select('*')->where('id_prestador','=', $id);
       
       $seviciosExtra->fill($request->all());
       $seviciosExtra->save();

        return  response()->json([$id_horario]);
        
     } */

}
