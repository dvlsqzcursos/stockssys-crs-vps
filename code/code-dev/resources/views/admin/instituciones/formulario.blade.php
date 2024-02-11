<div class="row">

    <div class="col-md-6">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('nombre', $institucion->nombre, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <label for="unit_id" ><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nivel / Tipo:</strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
            {!! Form::select('nivel', obtenerTiposInstitucion('list', null), $institucion->nivel,['class'=>'form-select']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Dirección: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('direccion', $institucion->direccion, ['class'=>'form-control']) !!}
        </div>
    </div>  
    
    <div class="col-md-6 mtop16"> 
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Ubicación: </strong></label>
        <div class="input-group">           
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                 
            <select name="id_ubicacion" id="id_ubicacion" style="width: 95%" >
                @foreach($ubicaciones as $u)
                    <option value=""></option>
                    <option value="{{ $u->id }}">{{ $u->nombre.' / '.$u->ubicacion_superior->nombre.' / '.$u->ubicacion_superior->ubicacion_superior->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row mtop16">

    <div class="col-md-4">
        <label for="name"> <strong> Encargado: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('encargado', $institucion->encargado, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <label for="name"> <strong>Contacto: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('contacto', $institucion->contacto, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <label for="name"> <strong>Correo: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('correo', $institucion->correo, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row mtop16">

    <div class="col-md-12">
        <label for="name"> <strong> Observaciones: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::textarea('observaciones', $institucion->observaciones, ['class'=>'form-control']) !!}
        </div>
    </div>

</div>