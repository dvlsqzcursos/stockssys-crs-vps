@extends('admin.plantilla.master')
@section('title','Kits')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/kits') }}"><i class="fa-solid fa-bowl-rice"></i> Kits</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Kit</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socio/kit/registrar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.kits.formulario')

                        @if(kvfj(Auth::user()->permisos, 'bodega_socio_kit_registrar'))
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-bowl-rice"></i> <strong> Listados de Kits</strong></h2>
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
                            @foreach($kits as $k)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_kit_editar'))
                                                <a href="{{ url('/admin/bodega_socio/kit/'.$k->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_kit_insumos'))
                                                <a href="{{ url('/admin/bodega_socio/kit/'.$k->id.'/insumos') }}"  title="Insumos"><i class="fa-solid fa-boxes-stacked"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'bodega_socio_kit_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/bodega_socio/kit" data-object="{{ $k->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{ $k->nombre}} <br>
                                        <span class="badge text-bg-dark">{{ $k->tipo_insumos }}</span>
                                    </td>
                                    <td>{{ obtenerOpcionesBeneficiarios(null, $k->asignado_a) }} </td>
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