@extends('admin.plantilla.master')
@section('title','Insumos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/insumos') }}"><i class="fa-solid fa-boxes-stacked"></i> Insumos</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Insumo</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/insumo/registrar', 'files' => true]) !!}
                        @include('admin.insumos.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-boxes-stacked"></i> Listado de Insumos</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> CATEGORIA </strong></td>
                        </thead>
                        <tbody>
                            @foreach($insumos as $i)
                                <tr>
                                    <td width="280px">
                                        <div class="opts">
                                            <a href="{{ url('/admin/insumo/'.$i->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @if($i->categoria == 0)
                                                <a href="{{ url('/admin/insumo/'.$i->id.'/pesos') }}"  title="Pesos"><i class="fa-solid fa-scale-unbalanced-flip"></i></a>
                                            @endif
                                            <a href="#" data-action="eliminar" data-path="admin/insumo" data-object="{{ $i->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>
                                        {{$i->nombre}} <br>
                                        <small><strong>Unidad Medida: </strong>{{ obtenerUnidadesMedidaInsumos(null, $i->id_unidad_medida) }}</small> 
                                    </td>
                                    <td>{{ obtenerCategoriaInsumos(null, $i->categoria) }}</td>
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