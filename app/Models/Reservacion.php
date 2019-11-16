<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Reservacion extends Model
{
    protected $table="reservacion";
    protected $primaryKey="id_reservacion";
    public $timestamps=false;

    protected $fillable=['id_cliente','id_prestador','fecha_hora','origen','destino','origenLatLong','destinoLatLong','seguro','numero_pisos','monto','status'];
}
