<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'solicitudes';
    protected $hidden = ['created_at', 'updated_at'];

    public function entrega(){
        return $this->hasOne(Entrega::class,'id','id_entrega');
    }

    public function usuario(){
        return $this->hasOne(Usuario::class,'id','id_usuario');
    }

    public function detalles(){
        return $this->hasMany(SolicitudDetalles::class,'id_solicitud','id');
    }
}
