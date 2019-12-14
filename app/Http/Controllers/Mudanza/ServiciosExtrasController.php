<?php

namespace App\Http\Controllers\Mudanza;

use App\Models\PrestadorServicio;
use App\Models\Horario_Tarifa;
use App\Models\Ranking;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ServiciosExtrasController extends Controller
{

    public function mostrar(Request $request){
        $id=$request->id;
        return response()->json(['servicios_extras'=>$id=Horario_Tarifa::select('dias','hora_inicio','hora_salida','costoXcargador','costoUnitarioCajaG','costoUnitarioCajaM','costoUnitarioCajaC','precio')
        ->where('id_prestador','=',$id)
        ->get()]);
    }
    public function insertar(Request $request){
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

    public function insertarconranking (Request $request){
        $request->validate([
            'id_prestador'=> ['required'],
            'valoracion'=> ['required']
        ]);
        $cliente = Ranking::create([
            'id_prestador' => $request['id_prestador'],
            'valoracion' => $request['valoracion']
        ]);
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


   public function actualizar(Request $request){
       $id = $request->id_prestador;
       $horario= Horario_Tarifa::select()->where('id_prestador',$id)->take(1)->first();
       $horario->dias=$request->dias;
       $horario->precio=$request->precio;
       $horario->hora_inicio=$request->hora_inicio;
       $horario->hora_salida=$request->hora_salida;
       $horario->costoXcargador=$request->costoXcargador;
       $horario->costoUnitarioCajaG=$request->costoUnitarioCajaG;
       $horario->costoUnitarioCajaM=$request->costoUnitarioCajaM;
       $horario->costoUnitarioCajaC=$request->costoUnitarioCajaC;
       $horario->save();
       return response()->json(["resultado"=>"correcto"]);

     }

}
