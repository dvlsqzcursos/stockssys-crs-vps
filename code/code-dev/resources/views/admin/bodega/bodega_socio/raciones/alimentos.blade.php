@extends('admin.plantilla.master')
@section('title','Alimentos de la Ración')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/raciones') }}"><i class="fa-solid fa-bowl-rice"></i> Raciones</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/raciones') }}"><i class="fa-solid fa-bowl-rice"></i> Alimentos de la Ración</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Añadir Alimento a Ración</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socio/racion/alimentos/asignar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.raciones.formulario_alimentos')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-bowl-rice"></i> <strong> Listados de Alimentos Que Conforman La Ración: </strong> {{ $racion->nombre }}</h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> ALIMENTO </strong></td>
                                <td><strong> CANTIDAD / UNIDAD DE MEDIDA </strong></td>
                        </thead>
                        <tbody>
                            @foreach($alimentos_racion as $ar)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="#" data-action="eliminar" data-path="admin/bodega_socio/racion/alimentos" data-object="{{ $ar->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>
                                        {{ $ar->alimento->nombre }} <br>
                                    </td>
                                    <td>{{ $ar->cantidad }}  {{ obtenerUnidadesMedidaRaciones(null, $ar->unidad_medida) }} </td>
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