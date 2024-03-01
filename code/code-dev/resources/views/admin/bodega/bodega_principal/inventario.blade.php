@extends('admin.plantilla.master')
@section('title','Bodega Principal')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Principal</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_principal/inventario') }}"><i class="fa-solid fa-calculator"></i> Inventario</a></li>
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
                    {!! Form::open(['url' => '/admin/bodega_principal/inventario/registrar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_principal.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-people-carry-box"></i> <strong> Listados de Inventario de Insumos</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> INSUMO</strong></td>
                                <td><strong> SALDO EN BODEGA </strong></td>
                        </thead>
                        <tbody>
                            @foreach($inventario as $i)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="{{ url('/admin/bodega_principal/'.$i->id.'/movimientos') }}"  title="Movimientos"><i class="fa-solid fa-people-carry-box"></i></a>
                                            <a href="#" data-action="eliminar" data-path="admin/entrega" data-object="{{ $i->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>{{ $i->insumo->nombre }}</td>
                                    <td>{{ $i->saldo }}</td>
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