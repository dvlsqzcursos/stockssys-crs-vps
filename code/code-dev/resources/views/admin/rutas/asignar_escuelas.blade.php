@extends('admin.plantilla.master')
@section('title','Asingar Escuelas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/rutas') }}"><i class="fa-solid fa-route"></i> Rutas</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/ruta'.$ruta->id.'/asignar_escuelas') }}"><i class="fa-solid fa-school"></i> Asginar Escuealas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Asignar Escuela</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ruta/asignar_escuelas', 'files' => true]) !!}

                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Escuela: </strong></label>
                        <div class="input-group">           
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            <select name="id_escuela" id="id_escuela" style="width: 89%" >
                                @foreach($escuelas as $e)
                                    <option value=""></option>
                                    <option value="{{ $e->id }}">{{ $e->codigo.' / '.$e->nombre }}</option>
                                @endforeach
                            </select>             
                        </div>

                        <label for="name " class="mtop16"> <strong>Orden de Llegada: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('orden_llegada', 1, ['class'=>'form-control', 'min'=>'1']) !!}
                        </div>

                        {!! Form::hidden('id_ruta', $ruta->id, ['class'=>'form-control']) !!}
                        

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-route"></i> Listado de Escuelas Asignadas A Ruta: {{$ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo}}</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> ESCUELA</strong></td>
                                <td><strong> ORDEN LLEGADA</strong></td>
                                <td><strong> NO. BENEFICIARIOS</strong></td>
                                <td><strong> DIRECTOR</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                        @php($total = 0)
                            @foreach($asignaciones as $as)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="#" data-action="eliminar" data-path="admin/ruta_asignaciones" data-object="{{ $as->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>                                        
                                        {{$as->escuela->nombre}}<br>
                                        <small><strong>Codigo:</strong> {{$as->escuela->codigo}}</small> 
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => '/admin/ruta/asignar_escuelas/actualizar_orden', 'files' => true]) !!}
                                            <div class="col-md-6">
                                                <div class="input-group"> 
                                                    {!! Form::hidden('id_asignacion', $as->id, ['class'=>'form-control']) !!}
                                                    {!! Form::number('orden', $as->orden_llegada, ['class'=>'form-control', 'min'=>'1']) !!}
                                                    {{ Form::button('<i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-sm', 'type' => 'submit']) }}
                                                </div>
                                            </div>         
                                            
                                        {!! Form::close() !!}                              
                                    </td>
                                    <td>
                                        {{$as->escuela->no_total_beneficiarios}}
                                        @php($total += $as->escuela->no_total_beneficiarios) 
                                    </td>
                                    <td>{{$as->escuela->director}}</td>
                                </tr>

                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <strong>Total de Beneficiarios: {{ $total }}</strong> 
                </div>
            </div>
        </div>

    </div>
</div>

@endsection