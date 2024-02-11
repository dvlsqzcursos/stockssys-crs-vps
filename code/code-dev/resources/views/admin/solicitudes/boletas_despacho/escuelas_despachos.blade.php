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
        <div class="col-md-4">
            @include('admin.solicitudes.boletas_despacho.vistas.menu_escuelas')
        </div>

        <div class="col-md-8">
            @include('admin.solicitudes.boletas_despacho.vistas.detalle_escuela')
        </div>       
    </div>
</div>

@endsection
