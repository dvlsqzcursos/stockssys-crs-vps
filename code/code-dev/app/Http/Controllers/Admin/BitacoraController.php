<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class BitacoraController extends Controller
{
    public function getInicio(){
        $bitacoras = Bitacora::with(['usuario'])->orderBy('created_at','desc')->get();

        $datos = [
            'bitacoras' => $bitacoras
        ];

        return view('admin.bitacoras.inicio',$datos);
    }
}
