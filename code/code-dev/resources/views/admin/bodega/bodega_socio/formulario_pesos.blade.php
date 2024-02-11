<div class="row">
    {!! Form::hidden('id_alimento',$id,['class' => 'form-control']) !!}
    <div class="col-md-4">
        <label for="name"> <strong>Gramos por libra: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('gramos_x_libra',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
                {!! Form::hidden('gramos_x_libra_ant',$pesos->gramos_x_libra,['class' => 'form-control']) !!}
            
        </div>
    </div> 

    <div class="col-md-4 ">
        <label for="name"> <strong>Gramos por Kg.: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('gramos_x_kg',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('gramos_x_kg_ant',$pesos->gramos_x_kg,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 ">
    <label for="name"> <strong>Libras por KG.: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('libras_x_kg',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('libras_x_kg_ant',$pesos->libras_x_kg,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <hr class="mtop16">

    <div class="col-md-4 ">
        <label for="name"> <strong>Kilogramos por unidad (Caneca/Saco): </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('kg_x_unidad',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('kg_x_unidad_ant',$pesos->kg_x_unidad,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 ">
        <label for="name"> <strong>Gramos x unidad: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('gramos_x_unidad',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('gramos_x_unidad_ant',$pesos->gramos_x_unidad,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 ">
    <label for="name"> <strong>Libras Netas por Unidad = Kg por unidad x Libras por Kg. : </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('libras_x_unidad',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('libras_x_unidad_ant',$pesos->libras_x_unidad,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 mtop16">
        <label for="name"> <strong>Quintales x unidad: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('quintales_x_unidad',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('quintales_x_unidad_ant',$pesos->quintales_x_unidad,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 mtop16">
        <label for="name"> <strong>Peso bruto en quintales (peso neto + caneca metalica): </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('peso_bruto_quintales',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('peso_bruto_quintales_ant',$pesos->peso_bruto_quintales,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 mtop16">
    <label for="name"> <strong>Tonelada Metrica Kg. : </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('tonelada_metrica_kg',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('tonelada_metrica_kg_ant',$pesos->tonelada_metrica_kg,['class' => 'form-control']) !!}
            
        </div>
    </div>

    <div class="col-md-4 mtop16">
    <label for="name"> <strong>Unidades por TM: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::number('unidades_x_tm',null,['class' => 'form-control','step' => 'any', 'min'=> '0']) !!}
            
            {!! Form::hidden('unidades_x_tm_ant',$pesos->unidades_x_tm,['class' => 'form-control']) !!}
            
        </div>
    </div>
    
    
</div>

