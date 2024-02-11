<div class="row">
    <h5><strong>Información de la Persona</strong></h5>       
    
    @if($editar == 0) 
        <div class="col-md-3">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Primer Nombre: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('p_nombre', $usuario->nombres, ['class'=>'form-control', 'id' =>'p_nombre']) !!}
            </div>
        </div>

        <div class="col-md-3">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Segundo Nombre: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('s_nombre', $usuario->nombres, ['class'=>'form-control', 'id' =>'s_nombre']) !!}
            </div>
        </div>

        <div class="col-md-3">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Primer Apellido: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('p_apellido', $usuario->apellidos, ['class'=>'form-control', 'id' =>'p_apellido']) !!}
            </div>
        </div>

        <div class="col-md-3">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Segundo Apellido: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('s_apellido', $usuario->apellidos, ['class'=>'form-control', 'id' =>'s_apellido']) !!}
            </div>
        </div>
    @endif
    @if($editar == 1) 
        <div class="col-md-6">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Primer Nombre: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('nombres', $usuario->nombres, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Primer Apellido: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('apellidos', $usuario->apellidos, ['class'=>'form-control']) !!}
            </div>
        </div>
    @endif

    <div class="col-md-6 mtop16">
        <label for="name"> <strong>Contacto: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('contacto', $usuario->contacto, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong>Correo: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('correo', $usuario->correo, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong>Puesto: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('puesto', $usuario->puesto, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Institución: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::select('id_institucion', $instituciones, $usuario->id_institucion ,['class'=>'form-select', 'id' => 'id_institucion', 'style' => 'width: 95%']) !!}
        </div>
    </div>
    
    

</div>

@if($editar == 0) 
    <hr />
    <div class="row mtop16">   
        
        <h5><strong>Información de Ingreso al Sistema</strong></h5>

        <div class="col-md-4">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Usuario: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('usuario', $usuario->usuario, ['class'=>'form-control', 'id' => 'frm_usuario']) !!}
                <a href="#" class="btn btn-sm btn-primary " id="btn_generar_usuario" ><i class="fa-solid fa-clipboard-user"></i> Generar</a>
            </div>
        </div>
            
        <div class="col-md-4">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Contraseña (Predeterminada): </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('contrasena', $contra_prede , ['class'=>'form-control', 'readonly']) !!} 
            </div>
        </div>

        <div class="col-md-4">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Pin de Autorizaciones (Predeterminada): </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('pin', $pin_prede, ['class'=>'form-control', 'readonly']) !!}
            </div>
        </div>
    

        <div class="col-md-6 mtop16">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Rol de Usuario: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::select('rol', obtenerRoles('list', null), $usuario->rol ,['class'=>'form-select', 'id' => 'rol', 'style' => 'width: 95%']) !!}
            </div>
        </div>

        <div class="col-md-6 mtop16">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Permisos (Predeterminados): </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::textarea('permisos', $usuario->permisos, ['class'=>'form-control', 'id' => 'frm_permisos','rows'=>'2', 'readonly']) !!}
            </div>
        </div>
        
    </div>
@endif


@if($editar == 1) 
    <hr />
    <div class="row mtop16">   
        <h5><strong>Información de Ingreso al Sistema (Solo Visualizar)</strong></h5>

        <div class="col-md-6">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Usuario: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('usuario', $usuario->usuario, ['class'=>'form-control', 'id' => 'frm_usuario', 'readonly']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Rol: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('rol', obtenerRoles(null, $usuario->rol), ['class'=>'form-control', 'readonly']) !!}
            </div>
        </div>

        <div class="col-md-12 mtop16">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Permisos (Predeterminados): </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::textarea('permisos', $usuario->permisos, ['class'=>'form-control', 'id' => 'frm_permisos','rows'=>'1', 'readonly']) !!}
            </div>
        </div>
    </div>

    <hr />
    <div class="row mtop16">   
        <h5><strong>Estado del Usuario</strong></h5>

        <div class="col-md-6">
            <label for="name"> <strong>Estado actual: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::text('usuario', obtenerEstadosUsuario(null, $usuario->estado), ['class'=>'form-control', 'id' => 'frm_usuario', 'readonly']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <label for="name"> <strong>Cambiar estado a: </strong></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                {!! Form::select('estado_nuevo', obtenerEstadosUsuario('list', $usuario->estado), $usuario->estado ,['class'=>'form-select',  'style' => 'width: 88%']) !!}
            </div>
        </div>

    </div>

@endif