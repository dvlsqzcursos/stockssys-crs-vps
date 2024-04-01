<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rutas';
    protected $fillable = ['correlativo','id_ubicacion','observaciones','estado','id_socio'];
    protected $hidden = ['created_at', 'updated_at'];

    public function ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','id_ubicacion');
    }

    public function detalles(){
        return $this->hasMany(RutaEscuela::class,'id_ruta','id');
    }
}
