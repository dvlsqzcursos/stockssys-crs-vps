@extends('admin.plantilla.master')
@section('title','Escuelas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-school"></i> Escuelas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        @if(kvfj(Auth::user()->permisos, 'escuela_importar'))
            <div class="col-md-3">
                <div class="card ">

                    <div class="card-header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Importar Escuelas</strong></h2>
                    </div>

                    <div class="card-body">
                        {!! Form::open(['url' => '/admin/escuela/importar', 'files' => true]) !!}
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cargar Archivo: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::file('escuelas') !!}
                            </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
                
            </div>
        @endif

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-school"></i> Listado de Escuelas</strong></h2>
                    <ul>              
                        @if(kvfj(Auth::user()->permisos, 'escuela_registrar'))         
                            <li>
                                <a href="{{ url('/admin/escuela/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> UBICACIÓN </strong></td>
                                <td><strong> RUTA </strong></td>
                        </thead>
                        <tbody>
                            @foreach($escuelas as $e)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'escuela_editar'))
                                                <a href="{{ url('/admin/escuela/'.$e->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'escuela_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/escuela" data-object="{{ $e->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{$e->nombre}} <br>
                                        <small><strong>Codigo: </strong>{{$e->codigo}}</small>
                                    </td>
                                    <td>
                                        {{$e->direccion}}<br>
                                        <small><strong>{{$e->ubicacion->nombre.' / '.$e->ubicacion->ubicacion_superior->nombre.' / '.$e->ubicacion->ubicacion_superior->ubicacion_superior->nombre}}</strong></small>
                                    </td>
                                    <td>
                                        @if($e->ruta_asignada)
                                            <span class="badge text-bg-primary">{{$e->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$e->ruta_asignada->ruta->correlativo}}</span>
                                        @else
                                            <span class="badge text-bg-danger">Sin Asignar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection