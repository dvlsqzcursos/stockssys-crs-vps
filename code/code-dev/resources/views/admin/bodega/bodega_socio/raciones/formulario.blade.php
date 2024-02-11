<label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::text('nombre', $racion->nombre, ['class'=>'form-control']) !!}
</div>

<label for="name" class="mtop16"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo de Actividad de Alimentos: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::text('tipo_alimentos', $racion->tipo_alimentos, ['class'=>'form-control']) !!}
</div>

<label for="unit_id"  class="mtop16"><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Dirigida A:</strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
    {!! Form::select('asignado_a', obtenerOpcionesBeneficiarios('list', null), $racion->asignado_a,['class'=>'form-select']) !!}
</div>

{!! Form::hidden('tipo_bodega', 1, ['class'=>'form-control']) !!}
