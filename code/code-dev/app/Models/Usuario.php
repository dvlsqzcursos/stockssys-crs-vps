<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $fillable = [
        'nombres',
        'apellidos',
        'contacto',
        'correo',
        'puesto',
        'id_institucion',
        'usuario',
        'password',
        'pin',
        'permisos',
        'estado'
    ];

    public function institucion(){
        return $this->hasOne(Institucion::class,'id','id_institucion');
    }
}
