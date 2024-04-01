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
                    {!! Form::open(['url' => '/admin/bodega_principal/insumo/registrar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_principal.formulario')

                        @if(kvfj(Auth::user()->permisos, 'bodega_principal_insumo_registrar')  && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9">  

            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Listado de Insumos</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> INSUMO</strong></td>
                                <td><strong> SALDO EN BODEGA </strong></td>
                                <td><strong> CATEGORIA/TIPO</strong></td>
                        </thead>
                        <tbody>
                            @foreach($insumos as $i)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if($i->categoria == 0)
                                                @if(kvfj(Auth::user()->permisos, 'bodega_principal_insumo_pesos'))
                                                    <a href="{{ url('/admin/bodega_principal/insumo/'.$i->id.'/pesos') }}"  title="Pesos"><i class="fa-solid fa-scale-unbalanced-flip"></i></a>
                                                @endif
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'bodega_principal_eliminar') && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                                                <a href="#" data-action="eliminar" data-path="admin/bodega_principal/insumo" data-object="{{ $i->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$i->nombre}}</td>
                                    <td>
                                        {{$i->saldo}} Unidades <br>
                                        <small><strong>Unidad: </strong> {{ obtenerUnidadesMedidaInsumos(null, $i->id_unidad_medida) }}</small>
                                    </td>
                                    <td>{{obtenerCategoriaInsumos(null, $i->categoria)}}</td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>

            </div>                
        </div>
        

        
    </div>

    <div class="row">  

        <div class="col-md-3 mtop16">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Controles de Solicitud</strong></h2>
                    
                </div>

                <div class="card-body">              
                    <div class="d-grid gap-2">
                        @if(kvfj(Auth::user()->permisos, 'bodega_principal_solicitudes'))
                            <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_principal/solicitudes_socios') }}" title="Solicitudes de Socios"><i class="fa-solid fa-file"></i> Solicitudes de Socios</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_principal_ingresos') && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                            <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_principal/insumo/ingresos') }}" title="Ingresos"><i class="fas fa-plus-circle"></i> Ingresos</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_principal_egresos') && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                            <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_principal/insumo/egresos') }}" title="Egresos"><i class="fas fa-minus-circle"></i> Egresos</a>
                        @endif

                        @if(kvfj(Auth::user()->permisos, 'bodega_principal_movimientos'))
                            <a  href="#" data-action="movimientos" data-path="admin/bodega_principal/insumo"  class="btn-eliminar btn btn-outline-primary" data-toogle="tooltrip" data-placement="top" title="Egresos" ><i class="fa-solid fa-clock-rotate-left"></i> Ver Historial de Movimientos</a>  
                        @endif
                        
                    </div>
                </div>

            </div>
        </div>
    
       

        

    </div>

</div>

@endsection