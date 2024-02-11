@extends('admin.plantilla.master')
@section('title','Bitacoras del Sistema')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/bitacoras') }}"><i class="fa-solid fa-user-clock"></i> Bitacoras</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-user-clock"></i> Listado de Bitacoras del Sistema</strong></h2>
                    <ul>                       
                        <li>
                            <a href="{{ url('/admin/usuario/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar Usuario</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> ACCIÓN </strong></td>
                                <td><strong> USUARIO </strong></td>
                                <td><strong> ROL </strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bitacoras as $b)
                                <tr>
                                    <td>{{$b->accion}} </td>
                                    <td>
                                        {{$b->usuario->usuario}} <br>
                                        <small><span class="badge text-bg-dark">{{$b->usuario->institucion->nombre}}</span></small>
                                        
                                    </td>
                                    <td>{{$b->created_at}}</td>
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