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
        Schema::create('alimentos_raciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_racion');
            $table->integer('id_alimento');
            $table->double('cantidad', 13, 5)->nullable();
            $table->integer('unidad_medida');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alimentos_raciones');
    }
};
