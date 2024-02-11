<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario, App\Models\Bitacora, App\Models\Institucion;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class UsuarioController extends Controller
{

    public function getInicio(){

        $usuarios = Usuario::with(['institucion'])->get();
        //$usuarios = Usuario::whereNotIn('rol', [0])->get();
        $contra_prede = Config::get('stocksys.contra_predeterminada').Carbon::now()->format('Y');
        $pin_prede = Config::get('stocksys.pin_predeterminado');

        $datos = [
            'usuarios' => $usuarios,
            'contra_prede' => $contra_prede,
            'pin_prede' => $pin_prede 
        ];

        return view('admin.usuarios.inicio',$datos);
    }

    public function getUsuarioRegistrar(){
        $usuario = new Usuario;
        $instituciones = Institucion::pluck('nombre', 'id');
        $contra_prede = Config::get('stocksys.contra_predeterminada').Carbon::now()->format('Y');
        $pin_prede = Config::get('stocksys.pin_predeterminado');
        $editar = 0;
        

        $datos = [
            'usuario' => $usuario,
            'instituciones' => $instituciones,
            'contra_prede' => $contra_prede,
            'pin_prede' => $pin_prede,
            'editar' => $editar
        ];

        return view('admin.usuarios.registrar',$datos);
    }

    public function postUsuarioRegistrar(Request $request){
        $reglas = [
            'p_nombre' => 'required',
            's_nombre' => 'required',
            'p_apellido' => 'required',
            's_apellido' => 'required',
            'id_institucion' => 'required',
            'usuario' => 'required'
        ];
        $mensajes = [
            'p_nombre.required' => 'Se requiere ingrese el 1er nombre de la persona.',
            's_nombre.required' => 'Se requiere ingrese el 2do nombre de la persona.',
            'p_apellido.required' => 'Se requiere ingrese el 1er apellido de la persona.',
            's_apellido.required' => 'Se requiere ingrese el 2do apellido de la persona.',
            'id_institucion.required' => 'Se requiere seleccione la institución donde labora la persona.',
            'usuario.required' => 'Se requiere genere el usuario de la persona.'
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else:           
            $contra_prede = Config::get('stocksys.contra_predeterminada').Carbon::now()->format('Y');
            $pin_prede = Config::get('stocksys.pin_predeterminado');

            $usuario = new Usuario;
            $usuario->nombres = e($request->input('p_nombre')).' '.e($request->input('s_nombre'));
            $usuario->apellidos = e($request->input('p_apellido')).' '.e($request->input('s_apellido'));
            $usuario->contacto = e($request->input('contacto'));
            $usuario->correo = e($request->input('correo'));
            $usuario->puesto = e($request->input('puesto'));
            $usuario->id_institucion = $request->input('id_institucion');  
            $usuario->usuario = e($request->input('usuario'));
            $usuario->password = Hash::make($contra_prede); 
            $usuario->pin = Hash::make($pin_prede); 
            $usuario->rol = $request->input('rol');                     
            $usuario->permisos = $this->obtenerPermisosPredeterminados($request->input('rol'));           
            $usuario->estado = '1';

            if($usuario->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de usuario: '.$usuario->usuario;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/usuarios')->with('messages', '¡El usuario se creo con éxito, ahora puede iniciar sesión!')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getUsuarioEditar($id){
        $editar = 1;
        $usuario = Usuario::findOrFail($id);
        $instituciones = Institucion::pluck('nombre', 'id');
        

        $datos = [
            'usuario' => $usuario,
            'instituciones' => $instituciones,
            'editar' => $editar
        ];

        return view('admin.usuarios.editar',$datos);
    }

    public function postUsuarioEditar(Request $request, $id){
        $reglas = [
            'nombres' => 'required',
            'apellidos' => 'required',
            'id_institucion' => 'required'
        ];
        $mensajes = [
            'nombres.required' => 'Se requiere ingrese los nombres de la persona.',
            'apellidos.required' => 'Se requiere ingrese los apellidos de la persona.',
            'id_institucion.required' => 'Se requiere seleccione la institución donde labora la persona.'
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
        if($validator->fails()):
            return back()->withErrors($validator)->with('messages', '¡Se ha producido un error!.')->with('typealert', 'danger');
        else:                  
            $usuario = Usuario::findOrFail($id);
            if(empty($request->input('nombres'))):
                $usuario->nombres = e($request->input('p_nombre')).' '.e($request->input('s_nombre'));
            else:
                $usuario->nombres = e($request->input('nombres'));
            endif;
            if(empty($request->input('apellidos'))):
                $usuario->apellidos = e($request->input('p_apellido')).' '.e($request->input('s_apellido'));
            else:
                $usuario->apellidos = e($request->input('apellidos'));
            endif;
            
            $usuario->contacto = e($request->input('contacto'));
            $usuario->correo = e($request->input('correo'));
            $usuario->puesto = e($request->input('puesto'));
            $usuario->estado = e($request->input('estado_nuevo'));

            if($usuario->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información del usuario: '.$usuario->usuario;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Informacion del usuario actualizada, con exito!')
                    ->with('typealert', 'info');
            endif;
        endif;
    }

    public function getUsuarioPermisos($id){
        $usuario = Usuario::findOrFail($id);        

        $datos = [
            'usuario' => $usuario
        ];

        return view('admin.usuarios.permisos',$datos);
    }

    public function postUsuarioPermisos(Request $request, $id){
        $usuario = Usuario::findOrFail($id);
        $usuario->permisos = json_encode($request->except(['_token']));

        if($usuario->save()):            
            $b = new Bitacora;
            $b->accion = 'Actualización de permisos del usuario: '.$usuario->usuario;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages','¡Los permisos del usuario fueron actualizados con éxito!.')
                ->with('typealert', 'info');
        endif;
    }

    public function getUsuarioRestablecerContra($id){

        $contra_prede = Config::get('stocksys.contra_predeterminada').Carbon::now()->format('Y');
        $usuario = Usuario::findOrFail($id);
        $usuario->password = Hash::make($contra_prede); 
        
        if($usuario->save()):
            $b = new Bitacora;
            $b->accion = 'Restablecimiento de contraseña del usuario: '.$usuario->usuario;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Contraseña restablecida con exito!.')->with('typealert', 'info');
        endif;
    }

    public function getUsuarioRestablecerPin($id){
        $pin_prede = Config::get('stocksys.pin_predeterminado');
        $usuario = Usuario::findOrFail($id);
        $usuario->pin = Hash::make($pin_prede);

        if($usuario->save()):
            $b = new Bitacora;
            $b->accion = 'Restablecimiento de pin de autorizaciones del usuario: '.$usuario->usuario;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Pin restablecido con exito!.')->with('typealert', 'info');
        endif;
    }

    public function getUsuarioEliminar($id){
        $usuario = Usuario::findOrFail($id);

        if($usuario->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación del usuario: '.$usuario->usuario;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Usuario eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function obtenerPermisosPredeterminados($rol){
        if($rol == 0):
            $permisos_defecto = [
                'panel_principal' => true,
                'ubicaciones' => true,
                'ubicacion_registrar' => true,
                'ubicacion_editar' => true,
                'ubicacion_eliminar' => true,
                'ubicacion_registrar_n1' => true,
                'ubicacion_editar_n1' => true,
                'ubicacion_eliminar_n1' => true,
                'ubicacion_registrar_n2' => true,
                'ubicacion_editar_n2' => true,
                'ubicacion_eliminar_n2' => true,
                'instituciones' => true,
                'institucion_registrar' => true,
                'institucion_editar' => true,
                'institucion_eliminar' => true,
                'usuarios' => true,
                'usuario_registrar' => true,
                'usuario_editar' => true,
                'usuario_eliminar' => true,
                'usuario_permisos' => true,
                'usuario_rest_contra' => true,
                'usuario_rest_pin' => true
            ];
        elseif($rol == 1):
            $permisos_defecto = [
                'panel_principal' => true,
                'ubicaciones' => true,
                'ubicacion_registrar' => true,
                'ubicacion_editar' => true,
                'ubicacion_eliminar' => true,
                'ubicacion_registrar_n1' => true,
                'ubicacion_editar_n1' => true,
                'ubicacion_eliminar_n1' => true,
                'ubicacion_registrar_n2' => true,
                'ubicacion_editar_n2' => true,
                'ubicacion_eliminar_n2' => true,
                'instituciones' => true,
                'institucion_registrar' => true,
                'institucion_editar' => true,
                'institucion_eliminar' => true,
                'usuarios' => true,
                'usuario_registrar' => true,
                'usuario_editar' => true,
                'usuario_eliminar' => true,
                'usuario_permisos' => true,
                'usuario_rest_contra' => true,
                'usuario_rest_pin' => true

            ];
        else:
            $permisos_defecto = [
                'panel_principal' => true
            ];
        endif;   

        $permisos = json_encode($permisos_defecto);
        return $permisos;
    }



    
}
