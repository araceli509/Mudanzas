<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table="cliente";
    protected $primaryKey="id_cliente";
    public $timestamps=false;

    protected $fillable=['nombre','apellidos','correo','direccion','telefono','codigo_postal','fecha_registro',	'status'];
}
