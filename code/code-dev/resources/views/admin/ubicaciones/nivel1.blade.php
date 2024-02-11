@extends('admin.plantilla.master')
@section('title','Ubicaciones')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Nivel 1</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Ubicación Nivel 1</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ubicacion/n1/registrar', 'files' => true]) !!}
                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="unit_id"  class="mtop16"><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nivel / Tipo:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('nivel', ['2' => 'Nivel 1'],1,['class'=>'form-select']) !!}
                        </div>

                        {!! Form::hidden('id_principal', $id, ['class'=>'form-control']) !!}

                        @if(kvfj(Auth::user()->permisos, 'ubicacion_registrar_n1'))
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-8">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-file-alt"></i> <strong> Listados de Ubicaciones Nivel 1 - {{ $ubicacion_principal->nombre }}</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> ID </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> NIVEL </strong></td>
                        </thead>
                        <tbody>
                            @foreach($ubicaciones_n1 as $u)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'ubicacion_editar_n1'))
                                                <a href="{{ url('/admin/ubicacion/'.$u->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'ubicacion_n2'))
                                                <a href="{{ url('/admin/ubicacion/'.$u->id.'/listado/n2') }}"  title="Listado"><i class="fa-solid fa-list"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'ubicacion_eliminar_n1'))
                                                <a href="#" data-action="eliminar" data-path="admin/ubicacion" data-object="{{ $u->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$u->id}}</td>
                                    <td>{{$u->nombre}}</td>
                                    <td>{{$u->nivel}}</td>
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