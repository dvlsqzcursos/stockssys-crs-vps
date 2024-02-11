@extends('admin.plantilla.master')
@section('title','Instituciones')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/instituciones') }}"><i class="fa-solid fa-building"></i> Instituciones</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Listado de Instituciones</strong></h2>
                    <ul>   
                        @if(kvfj(Auth::user()->permisos, 'institucion_registrar'))                    
                            <li>
                                <a href="{{ url('/admin/institucion/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar</a>
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
                                <td><strong> ESTADO </strong></td>
                        </thead>
                        <tbody>
                            @foreach($instituciones as $i)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'institucion_editar'))
                                                <a href="{{ url('/admin/institucion/'.$i->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'institucion_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/institucion" data-object="{{ $i->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$i->nombre}}</td>
                                    <td>
                                        {{$i->direccion}}<br>
                                        {{$i->ubicacion->nombre.' / '.$i->ubicacion->ubicacion_superior->nombre.' / '.$i->ubicacion->ubicacion_superior->ubicacion_superior->nombre}}
                                    </td>
                                    <td>{{$i->estado}}</td>
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