<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mudanzas extends Model
{
    protected $table="mudanzas";
    protected $primaryKey="id_mudanza";
    public $timestamps=false;

    protected $fillable=['id_mudanza','id_cliente','id_prestador','origen','destino','distancia','tiempo',	'fecha_mudanza','hora','status'];

    public function cliente()
    {
      return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function prestador()
    {
      return $this->belongsTo(PrestadorServicio::class,'id_prestador');
    }



}
