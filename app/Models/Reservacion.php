<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Reservacion extends Model
{
    protected $table="reservacion";
    protected $primaryKey="id_reservacion";
    public $timestamps=false;
    protected $fillable=['id_cliente','id_prestador','fecha_hora','origen','destino','origenLatLong','destinoLatLong','distancia','seguro','numero_pisos','monto','numeroCajas','numTrabajadores','status'];

    public function PrestadorServicio()
    {
       return $this->belongsTo(PrestadorServicio::class,'id_prestador');
    }
    public function Cliente()
    {
      return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
