<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('id_unidad_medida')->nullable(); 
            $table->integer('categoria')->nullable();
            $table->double('saldo',13, 5)->nullable();
            $table->string('observaciones', 500)->nullable();            
            $table->integer('tipo_bodega');
            $table->integer('id_institucion');
            $table->timestamps();
            $table->softDeletes();
        });

        /*DB::unprepared('SELECT 1; SET IDENTITY_INSERT bodegas ON');
        DB::table('bodegas')->insert(array(
            'id'=>'1',
            'nombre'=>'Maiz USDA',
            'id_unidad_medida'=>1,
            'categoria'=>0,
            'saldo'=>0,
            'observaciones'=>null,
            'tipo_bodega'=>1,
            'id_institucion'=>2,
        ));

        DB::table('bodegas')->insert(array(
            'id'=>'2',
            'nombre'=>'Maiz BIO',
            'id_unidad_medida'=>1,
            'categoria'=>0,
            'saldo'=>0,
            'observaciones'=>null,
            'tipo_bodega'=>1,
            'id_institucion'=>2,    
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT bodegas OFF');*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodegas');
    }
};
