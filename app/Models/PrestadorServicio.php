<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestadorServicio extends Model
{
    protected $table="prestador_servicio";
    protected $primaryKey="id_prestador";
    public $timestamps=false;

    protected $fillable=['nombre','apellidos','direccion','telefono','correo','codigo_postal','foto_perfil','status','solicitud','foto_perfil'];
}
