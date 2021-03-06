<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario_Tarifa extends Model
{
    protected $table="horario_tarifa";
    protected $primaryKey="id_horario";
    public $timestamps=false;
    protected $fillable=['id_prestador','dias','hora_inicio','hora_salida','costoXcargador','costoUnitarioCajaG','costoUnitarioCajaM','costoUnitarioCajaC','precio'];

    public function prestador()
    {
      return $this->belongsTo(PrestadorServicio::class,'id_prestador');
    }

}
