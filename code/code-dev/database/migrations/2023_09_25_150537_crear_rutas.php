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
        Schema::create('rutas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('correlativo');
            $table->integer('id_ubicacion');
            $table->string('observaciones', 500)->nullable(); 
            $table->integer('estado');
            $table->integer('id_socio');
            $table->timestamps();
            $table->softDeletes();
        });

        /*DB::unprepared('SELECT 1; SET IDENTITY_INSERT rutas ON');
        DB::table('rutas')->insert(array(
            'id'=>'1',
            'correlativo'=>1,
            'id_ubicacion'=>3,
            'observaciones'=>null,
            'estado'=>0,
            'id_socio'=>2 
        ));

        DB::table('rutas')->insert(array(
            'id'=>'2',
            'correlativo'=>2,
            'id_ubicacion'=>3,
            'observaciones'=>null,
            'estado'=>0,
            'id_socio'=>2  
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT rutas OFF');*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
