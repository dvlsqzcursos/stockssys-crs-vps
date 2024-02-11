<h5><strong>Información de la Escuela</strong></h5>
<div class="row">

    <div class="col-md-6">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Codigo: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $escuela->codigo, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('nombre', $escuela->nombre, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Dirección: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('direccion', $escuela->direccion, ['class'=>'form-control']) !!}
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

    <div class="col-md-6">
        <label for="name"> <strong> Director: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('director', $escuela->director, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <label for="name"> <strong>Contacto #1: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('contacto_no1', $escuela->contacto_no1, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong>Contacto #2: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('contacto_no2', $escuela->contacto_no2, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-12 mtop16">
        <label for="name"> <strong> Observaciones: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::textarea('observaciones', $escuela->observaciones, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
    </div>

    
</div>

<hr />
<h5><strong>Información de Beneficiarios</strong></h5>

<div class="row mtop16">

    <div class="col-md-6 ">
        <label for="name"> <strong>No. Niños y Niñas de Pre Primaria a Tercero Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_preprimaria_tercero', $escuela->no_preprimaria_tercero, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

    <div class="col-md-6 ">
        <label for="name"> <strong>No. Niños y Niñas de Cuarto Primaria a Sexto Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_cuarto_sexto', $escuela->no_cuarto_sexto, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong>No. Lideres: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_lideres', $escuela->no_lideres, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16">
        <label for="name"> <strong>No. Voluntarios: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_voluntarios', $escuela->no_voluntarios, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

</div>