<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Ubicacionprestador extends Model
{
    protected $table="ubicacionprestador";

    public $timestamps=false;
    protected $fillable=['id_prestador','id_cliente','uid_prestador'];

    public function PrestadorServicio()
    {
       return $this->belongsTo(PrestadorServicio::class,'id_prestador');
    }
    public function Cliente()
    {
      return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
