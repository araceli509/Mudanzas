<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mudanzas extends Model
{
    protected $table="mudanzas";
    protected $primaryKey="id_mudanza";
    public $timestamps=false;

    protected $fillable=['id_mudanza','id_cliente','id_prestador','origen','destino','distanci','tiempo',	'fecha_mudanza'];
}
