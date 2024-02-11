<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RutaEscuela extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rutas_escuelas';
    protected $hidden = ['created_at', 'updated_at'];

    public function ruta(){
        return $this->hasOne(Ruta::class,'id','id_ruta');
    }

    public function escuela(){
        return $this->hasOne(Escuela::class,'id','id_escuela');
    }
}
