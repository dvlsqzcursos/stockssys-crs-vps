@extends('admin.plantilla.master')
@section('title','Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}"><i class="fa-solid fa-users"></i> Usuarios</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuario/'.$usuario->id.'/editar') }}"><i class="fa-solid fa-users"></i> Editar Usuario</a></li>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Usuario</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/usuario/'.$usuario->id.'/editar', 'files' => true]) !!}

                        @include('admin.usuarios.formulario')

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection