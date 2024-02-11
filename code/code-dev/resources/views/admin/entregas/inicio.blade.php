@extends('admin.plantilla.master')
@section('title','Entregas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/entregas') }}"><i class="fa-solid fa-people-carry-box"></i> Entregas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Entrega</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/entrega/registrar', 'files' => true]) !!}
                        @include('admin.entregas.formulario')

                        @if(kvfj(Auth::user()->permisos, 'entrega_registrar'))
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-people-carry-box"></i> <strong> Listados de Entregas</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> CORRELATIVO - AÑO</strong></td>
                                <td><strong> MES INICIAL / FINAL </strong></td>
                                <td><strong> DIAS A CUBRIR </strong></td>
                        </thead>
                        <tbody>
                            @foreach($entregas as $e)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'entrega_editar'))
                                                <a href="{{ url('/admin/entrega/'.$e->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'entrega_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/entrega" data-object="{{ $e->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $e->correlativo.'-'.$e->year }}</td>
                                    <td>{{ obtenerMeses(null, $e->mes_inicial).' / '.obtenerMeses(null, $e->mes_final) }} </td>
                                    <td>{{ $e->dias_a_cubrir }}</td>
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