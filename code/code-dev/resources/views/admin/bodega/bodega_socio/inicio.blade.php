@extends('admin.plantilla.master')
@section('title','Bodega Socio')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Socio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/inventario') }}"><i class="fa-solid fa-calculator"></i> Inventario</a></li>
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
                    {!! Form::open(['url' => '/admin/bodega_socio/insumo/registrar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.formulario')

                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_insumo_registrar') && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                            
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insumos as $i)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if($i->categoria == 0)
                                                @if(kvfj(Auth::user()->permisos, 'bodega_socio_insumo_pesos'))
                                                    <a href="{{ url('/admin/bodega_socio/insumo/'.$i->id.'/pesos') }}"  title="Pesos"><i class="fa-solid fa-scale-unbalanced-flip"></i></a>
                                                @endif
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_eliminar') && Auth::user()->rol != 0 && Auth::user()->rol != 1 )
                                                <a href="#" data-action="eliminar" data-path="admin/bodega_socio/insumo" data-object="{{ $i->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$i->nombre}}</td>
                                    <td>
                                        {{$i->saldo}} Unidades<br>
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
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Controles de la Bodega</strong></h2>
                    
                </div>

                <div class="card-body">              
                    <div class="d-grid gap-2">
                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_solicitudes') )
                            <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/solicitudes_bodega_principal') }}" title="Solicitudes Bodega Primaria"><i class="fa-solid fa-file"></i> Solicitudes a Bodega Primaria</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_ingresos') && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                            <a  href="#" data-action="ingresos" data-path="admin/bodega_socio/insumo"  class="btn-eliminar btn btn-outline-primary" data-toogle="tooltrip" data-placement="top" title="Ingresos" ><i class="fas fa-plus-circle"></i> Ingresos</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_egresos') && Auth::user()->rol != 0 && Auth::user()->rol != 1)
                            <a  href="#" data-action="egresos" data-path="admin/bodega_socio/insumo"  class="btn-eliminar btn btn-outline-primary" data-toogle="tooltrip" data-placement="top" title="Egresos" ><i class="fas fa-minus-circle"></i> Egresos</a>  
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_movimientos'))
                            <a  href="#" data-action="movimientos" data-path="admin/bodega_socio/insumo"  class="btn-eliminar btn btn-outline-primary" data-toogle="tooltrip" data-placement="top" title="Egresos" ><i class="fa-solid fa-clock-rotate-left"></i> Ver Historial de Movimientos</a>  
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_raciones'))
                            <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/raciones/1') }}" title="raciones"><i class="fa-solid fa-bowl-rice"></i> Raciones</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_kits'))
                            <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/kits/1') }}" title="lits"><i class="fa-solid fa-boxes-stacked"></i> Kits</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    
       

        

    </div>

</div>

@endsection