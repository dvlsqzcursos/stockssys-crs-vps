<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacoras';
    protected $hidden = ['created_at', 'updated_at'];

    public function usuario(){
        return $this->hasOne(Usuario::class,'id','id_usuario');
    }
}
