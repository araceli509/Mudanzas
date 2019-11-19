<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table="vehiculos2";
    protected $primaryKey="id_vehiculo";
    public $timestamps=false;

    protected $fillable=['id_prestador','modelo','placas','capacidad_carga','foto_frontal','foto_lateral','foto_trasera'];
}
