<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institucion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'instituciones';
    protected $hidden = ['created_at', 'updated_at'];

    public function ubicacion(){
        return $this->hasOne(Ubicacion::class,'id','id_ubicacion');
    }

}
