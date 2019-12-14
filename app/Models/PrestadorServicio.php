<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestadorServicio extends Model
{
    protected $table="prestador_servicio";
    protected $primaryKey="id_prestador";
    public $timestamps=false;

    protected $fillable=['id_prestador','nombre','apellidos','direccion','telefono','correo','codigo_postal','status','solicitud','foto_perfil'];

    public function MisSolicitudes()
    {
     return $this->hasMany(Rerservacion::class,'id_reservacion');
    }
    public function misPagos()
    {
      return $this->hasMany(Pago::class,'id_pago');
    }
    public function misComentarios()
    {
      return $this->hasMany(Comentario::class,'id_comentario');
    }
    public function misMudanzas()
    {
      return $this->hasMany(Mudanzas::class,'id_prestador');
    }
    public function misTarifas(){
      return $this->hasMany(Horario_Tarifa::class,'id_prestador');

    }

}
