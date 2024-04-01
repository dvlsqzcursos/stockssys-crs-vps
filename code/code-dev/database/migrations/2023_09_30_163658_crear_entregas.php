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
        Schema::create('entregas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('correlativo');
            $table->integer('mes_inicial');
            $table->integer('mes_final');
            $table->integer('dias_a_cubrir');
            $table->integer('year');
            $table->integer('id_socio');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared('SELECT 1; SET IDENTITY_INSERT entregas ON');
        DB::table('entregas')->insert(array(
            'id'=>'1',
            'correlativo'=>1,
            'mes_inicial'=>2,
            'mes_final'=>4,
            'dias_a_cubrir'=>60,
            'year'=>2024,
            'id_socio'=>2      
        ));

        DB::table('entregas')->insert(array(
            'id'=>'2',
            'correlativo'=>1,
            'mes_inicial'=>2,
            'mes_final'=>4,
            'dias_a_cubrir'=>60,
            'year'=>2024,
            'id_socio'=>2      
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT entregas OFF');
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
