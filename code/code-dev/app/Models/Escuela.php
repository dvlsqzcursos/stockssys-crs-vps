<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escuela extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'escuelas';
    protected $fillable = ['jornada', 'codigo','nombre', 'direccion', 'id_ubicacion', 'no_total_beneficiarios','director','estado','id_socio'];
    protected $hidden = ['created_at', 'updated_at'];

    public function ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','id_ubicacion');
    }

    public function ruta_asignada(){
        return $this->hasOne(RutaEscuela::class,'id_escuela','id');
    }

    public function solicitudes(){
        return $this->hasMany(SolicitudDetalles::class, 'id_escuela', 'id');
    }
}
