<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table="ranking";
    protected $primaryKey="id_ranking";
    public $timestamps=false;
    protected $fillable=['id_ranking','id_prestador','valoracion'];
}
