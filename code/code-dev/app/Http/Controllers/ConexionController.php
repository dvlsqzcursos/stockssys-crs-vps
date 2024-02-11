<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash,Auth,Mail,Str;
use App\User;

class ConexionController extends Controller
{
    public function getIniciarSesion(){
        return view('conexion.inicio_sesion');
    }

    public function postIniciarSesion(Request $request){
        $reglas = [
            'usuario' => 'required',
            'contrasena' => 'required|min:8'
        ];

        $mensajes = [
            'usuario.required' => 'Ingrese su usuario.',
            'contrasena.required' => 'Por favor escriba su contraseña.'
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);

        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', 'Se ha producido un error')
            ->with('typealert', 'danger');
        else:
            if(Auth::attempt(['usuario' => $request->input('usuario'), 'password'=>$request->input('contrasena')], true )):
                if(Auth::user()->estado == "1"):
                    return redirect('/cerrar_sesion');
                else:
                    return redirect('/admin');
                endif;
                
            else:
                return back()->with('messages', 'Usuario o contraseña errónea')
                ->with('typealert', 'danger');
            endif;
        
        endif;
    }

    public function getCerraSesion(){
        $estado= Auth::user()->estado;
        Auth::logout();

        if($estado== "1"):
            return redirect('/iniciar_sesion')->with('messages', 'Su usuario fue suspéndido.')
            ->with('typealert', 'danger');
        else:
            return redirect('/iniciar_sesion');
        endif;
        
    }
}
