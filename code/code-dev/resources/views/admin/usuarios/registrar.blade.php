@extends('admin.plantilla.master')
@section('title','Registar Institución')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}"><i class="fa-solid fa-users"></i> Usuarios</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuario/registrar') }}"><i class="fa-solid fa-users"></i> Registrar Usuario</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Usuario</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/usuario/registrar', 'files' => true]) !!}

                        @include('admin.usuarios.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@include('admin.usuarios.scripts')

@endsection