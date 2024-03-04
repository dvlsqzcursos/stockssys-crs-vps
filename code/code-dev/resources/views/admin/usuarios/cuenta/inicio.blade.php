@extends('admin.plantilla.master')
@section('title','Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}"><i class="fa-solid fa-users"></i> Usuarios</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-fingerprint"></i> Cambiar Contraseña</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/cambio_password_usuario']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name"><strong>Contraseña Actual:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('apassword', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name"><strong>Nueva Contraseña:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('password', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name"><strong>Confirmar Contraseña:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::password('cpassword', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>

                
            </div>
        </div>

        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-user"></i> Información de Usuario</strong></h2>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <label for="name"><strong>Nombre:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', Auth::user()->nombres.' '.Auth::user()->apellidos, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="email"><strong>Contacto:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('email', Auth::user()->contacto, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="phone"><strong>Correo:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('phone', Auth::user()->correo, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="email"><strong>Usuario:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('email', Auth::user()->usuario, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 mtop16">
                            <label for="phone"><strong>Rol:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('rol', obtenerRoles(null, Auth::user()->rol) , ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>

                        <div class="col-md-12 mtop16">
                            <label for="phone"><strong>Permisos Asignados:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::textarea('phone',  Auth::user()->permisos, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>

                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>

@endsection