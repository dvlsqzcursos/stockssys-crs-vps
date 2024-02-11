@extends('admin.plantilla.master')
@section('title','Raciones')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/raciones') }}"><i class="fa-solid fa-bowl-rice"></i> Raciones</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Racion</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socio/racion/registrar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.raciones.formulario')

                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_racion_registrar'))
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-bowl-rice"></i> <strong> Listados de Raciones</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE</strong></td>
                                <td><strong> ASIGNADO A </strong></td>
                        </thead>
                        <tbody>
                            @foreach($raciones as $r)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_racion_editar'))
                                                <a href="{{ url('/admin/bodega_socio/racion/'.$r->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_racion_alimentos'))
                                                <a href="{{ url('/admin/bodega_socio/racion/'.$r->id.'/alimentos') }}"  title="Alimentos"><i class="fa-solid fa-bowl-rice"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_racion_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/bodega_socio/racion" data-object="{{ $r->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{ $r->nombre}} <br>
                                        <span class="badge text-bg-dark">{{ $r->tipo_alimentos }}</span>
                                    </td>
                                    <td>{{ obtenerOpcionesBeneficiarios(null, $r->asignado_a) }} </td>
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