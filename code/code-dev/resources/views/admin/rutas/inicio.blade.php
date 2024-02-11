@extends('admin.plantilla.master')
@section('title','Rutas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/rutas') }}"><i class="fa-solid fa-route"></i> Rutas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Ruta</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ruta/registrar', 'files' => true]) !!}
                        @include('admin.rutas.formulario')

                        @if(kvfj(Auth::user()->permisos, 'ruta_registrar'))
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-route"></i> Listado de Rutas</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> RUTA </strong></td>
                                <td><strong> ESTADO </strong></td>
                        </thead>
                        <tbody>
                            @foreach($rutas as $r)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'ruta_asignar_escuelas'))
                                                <a href="{{ url('/admin/ruta/'.$r->id.'/asignar_escuelas') }}"  title="Escuelas"><i class="fa-solid fa-school"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'ruta_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/ruta" data-object="{{ $r->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        Ruta {{$r->ubicacion->nomenclatura.'0'.$r->correlativo}} <br>
                                        {{$r->ubicacion->nombre.' / '.$r->ubicacion->ubicacion_superior->nombre.' / '.$r->ubicacion->ubicacion_superior->ubicacion_superior->nombre}}
                                    </td>
                                    <td>{{$r->estado}}</td>
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