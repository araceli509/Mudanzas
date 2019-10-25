<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table="documentos";
    protected $primaryKey="id_documentos";
    public $timestamps=false;

    protected $fillable=['id_documentos','licencia_vigente','tarjeta_circulacion','ine'];
}
