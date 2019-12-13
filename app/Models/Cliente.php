<?php

namespace App\Models;
use App\Models\Mudanzas;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table="cliente";
    protected $primaryKey="id_cliente";
    public $timestamps=false;

    protected $fillable=['id_cliente','nombre','apellidos','correo','direccion','telefono','codigo_postal','fecha_registro',	'status'];
    public function misReservaciones()
    {
      return $this->hasMany(Reservacion::class,'id_reservacion');
    }
    public function misPagos()
    {
      return $this->hasMany(Pago::class,'id_pago');
    }
    public function mismudanzas()
    {
      return $this->hasMany('App\Models\Mudanzas','id_mudanza');
    }


}
