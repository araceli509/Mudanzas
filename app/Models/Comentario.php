<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table="comentario";
    protected $primaryKey="id_comentario";
    public $timestamps=false;

    protected $fillable=['id_comentario','descripcion','fecha_comentario','id_cliente','status','id_prestador'];
}
