<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'kits';
    protected $hidden = ['created_at', 'updated_at'];

    public function insumos(){
        return $this->hasMany(InsumoRacion::class,'id_insumo','id');
    }
}
