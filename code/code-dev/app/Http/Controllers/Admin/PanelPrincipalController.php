<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelPrincipalController extends Controller
{
    public function getInicio(){       

        $datos = [
            
        ];

        return view('admin.panel_principal.inicio',$datos);
    }
}
