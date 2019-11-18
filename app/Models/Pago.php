<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table="pago";
    protected $primaryKey="id_pago";
    public $timestamps=false;

    protected $fillable=['id_cliente','id_prestador','numero_transaccion','monto','fecha_pago','status','id_mudanza'];

    public function Cliente()
    {
      return $this->belongsTo(Cliente::class,'id_cliente');
    }

}
