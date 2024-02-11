@extends('admin.plantilla.master')
@section('title','Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}"><i class="fa-solid fa-users"></i> Usuarios</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-users"></i> Listado de Usuarios</strong></h2>
                    <ul>    
                        @if(kvfj(Auth::user()->permisos, 'usuario_registrar'))                   
                            <li>
                                <a href="{{ url('/admin/usuario/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar Usuario</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="card-body">
                    {!! Form::hidden('contra_prede', $contra_prede, ['class'=>'form-control', 'id' => 'contra_prede']) !!}
                    {!! Form::hidden('pin_prede', $pin_prede, ['class'=>'form-control', 'id' => 'pin_prede']) !!}
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> USUARIO </strong></td>
                                <td><strong> ROL </strong></td>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $u)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'usuario_editar'))
                                                <a href="{{ url('/admin/usuario/'.$u->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'usuario_permisos'))
                                                <a href="{{ url('/admin/usuario/'.$u->id.'/permisos') }}"  title="Permsisos"><i class="fa-solid fa-user-shield"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'usuario_rest_contra'))
                                                <a href="#" data-action="rest-contra" data-path="admin/usuario" data-object="{{ $u->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Restablecer Contraseña" ><i class="fa-solid fa-user-lock"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'usuario_rest_pin'))
                                                <a href="#" data-action="rest-pin" data-path="admin/usuario" data-object="{{ $u->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Restablecer Pin de Autorizaciones" ><i class="fa-solid fa-key"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'usuario_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/usuario" data-object="{{ $u->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{$u->nombres.' '.$u->apellidos}} <br>
                                        Institución: {{$u->institucion->nombre}}
                                    </td>
                                    <td>
                                        {{$u->usuario}} <br> 
                                        @if($u->estado == 0)
                                            <span class="badge text-bg-success">{{ obtenerEstadosUsuario(null, $u->estado) }}</span>
                                        @else
                                            <span class="badge text-bg-danger">{{ obtenerEstadosUsuario(null, $u->estado) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ obtenerRoles(null, $u->rol) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>
    </div>
</div>

@endsection