<h5><strong>Información de la Escuela</strong></h5>
<div class="row">
    <div class="col-md-2">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo Jornada: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
            {!! Form::select('jornada', ['0'=>'Matutina','1'=>'Vespertina'],0,['class'=>'form-select']) !!}
        </div>
    </div>  

    <div class="col-md-3">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Codigo: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $escuela->codigo, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-7">
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
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Director: </strong></label>
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

    <div class="col-md-6">
        <label for="unit_id" ><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> ¿Desea desglozar el dato de beneficiarios?:</strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
            {!! Form::select('desgloce', ['0'=>'No','1'=>'Si'],0,['class'=>'form-select', 'id' => 'desgloce']) !!}
        </div>
    </div>

    <div class="col-md-6" id="div-total-beneficiarios">
        <label for="name"> <strong>No. Total de Beneficiarios: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_total_beneficiarios', $escuela->no_total_beneficiarios, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>


    <div class="col-md-6" id="div-beneficiarios-desgloce-niños-pre">
        <label for="name"> <strong>No. Niños de Pre Primaria a Tercero Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_ninos_pre', $escuela->no_ninos_pre, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16" id="div-beneficiarios-desgloce-niñas-pre">
        <label for="name"> <strong>No. Niñas de Pre Primaria a Tercero Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_ninas_pre', $escuela->no_ninas_pre, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16" id="div-beneficiarios-desgloce-niños-pri">
        <label for="name"> <strong>No. Niños de Cuarto Primaria a Sexto Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_ninos_pri', $escuela->no_ninos_pri, ['class'=>'form-control', 'min'=>'1']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16" id="div-beneficiarios-desgloce-niñas-pri">
        <label for="name"> <strong>No. Niñas de Cuarto Primaria a Sexto Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('no_ninas_pri', $escuela->no_ninas_pri, ['class'=>'form-control', 'min'=>'1']) !!}
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

@include('admin.escuelas.scripts')