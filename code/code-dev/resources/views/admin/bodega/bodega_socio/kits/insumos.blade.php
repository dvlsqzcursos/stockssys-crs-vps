@extends('admin.plantilla.master')
@section('title','Insumos del Kit')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/raciones') }}"><i class="fa-solid fa-bowl-rice"></i> Kits</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/raciones') }}"><i class="fa-solid fa-bowl-rice"></i> Insumos del Kit</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Añadir Insumo a Kit</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socio/kit/insumos/asignar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.kits.formulario_insumos')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-bowl-rice"></i> <strong> Listados de Insumos Que Conforman El Kit: </strong> {{ $kit->nombre }}</h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> INSUMO </strong></td>
                                <td><strong> CANTIDAD </strong></td>
                        </thead>
                        <tbody>
                            @foreach($insumos_kit as $ik)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="#" data-action="eliminar" data-path="admin/bodega_socio/kit/insumos" data-object="{{ $ik->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>
                                        {{ $ik->insumo->nombre }} <br>
                                    </td>
                                    <td>{{ $ik->cantidad }} </td>
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