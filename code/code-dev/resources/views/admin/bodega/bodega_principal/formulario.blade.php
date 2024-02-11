<div class="row">
    <div class="col-md-12">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('nombre', $insumo->nombre, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-12 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Presentación / Unidad de Medida: </strong></label>
        <div class="input-group"> 
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::select('id_unidad_medida', obtenerUnidadesMedidaInsumos('list', null), $insumo->id_unidad_medida,['class'=>'form-select']) !!} 
        </div>
    </div>

    <div class="col-md-12 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Categoria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::select('categoria', obtenerCategoriaInsumos('list', null), $insumo->id_unidad_medida,['class'=>'form-select']) !!} 
        </div>
    </div>

    <div class="col-md-12 mtop16">
        <label for="name"> <strong> Observaciones: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::textarea('observaciones', $insumo->observaciones, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
    </div>
    
    
</div>
