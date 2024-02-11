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
        DB::unprepared('
            create trigger tr_aumentarSaldo on bodegas_ingresos_detalles
            for insert
            as
            declare @cantidad integer;
            declare @idinsumo integer;
            declare @saldo integer;

            select @cantidad = no_unidades from inserted;
            select @idinsumo = id_insumo from inserted;
            set @saldo = (select saldo from bodegas where id = @idinsumo);
            begin
            update bodegas set saldo = saldo+@cantidad where id = @idinsumo;
            end
        ');
        /*DB::unprepared('
            CREATE TRIGGER tr_aumentarSaldo AFTER INSERT ON bodegas_ingresos_detalles
            FOR EACH ROW BEGIN 
                UPDATE bodegas SET saldo = saldo + NEW.no_unidades WHERE bodegas.id = NEW.id_insumo;
            END 
        ');*/

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER "tr_aumentarSaldo"');
    }
};
