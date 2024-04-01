<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrega extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'entregas';
    protected $fillable = ['correlativo','mes_inicial','mes_final','dias_a_cubrir','year','id_socio'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
