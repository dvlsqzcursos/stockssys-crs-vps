@extends('admin.plantilla.master')
@section('title','Desgloce de Rutas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')
@php($total_raciones = 0)
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            @include('admin.solicitudes.detalles.vista_desgloce.menu_rutas')
        </div>

        <div class="col-md-10">
            @include('admin.solicitudes.detalles.vista_desgloce.detalle_ruta')
        </div>       
    </div>

    @if(kvfj(Auth::user()->permisos, 'solicitud_rutas_administrar'))
        <div class="row mtop16" style="text-align:center;">                 
            @include('admin.solicitudes.detalles.vista_desgloce.administracion_ruta')
        </div>
    @endif
</div>

@endsection
