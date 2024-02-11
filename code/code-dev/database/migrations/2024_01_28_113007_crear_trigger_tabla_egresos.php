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
            create trigger tr_disminuirSaldo on bodegas_egresos_detalles
            for insert
            as
            declare @cantidad integer;
            declare @idinsumo integer;
            declare @saldo integer;
            declare @pl integer;
            declare @no_unidades_usadas integer;
            
            select @cantidad = no_unidades from inserted;
            select @idinsumo = id_insumo from inserted;
            select @pl = pl from inserted;
            set @saldo = (select saldo from bodegas where id = @idinsumo);
            set @no_unidades_usadas = (select no_unidades_usadas from bodegas_ingresos_detalles where pl = @pl or id_insumo = @idinsumo);
            begin
            update bodegas set saldo = saldo-@cantidad where id = @idinsumo;
            update bodegas_ingresos_detalles set no_unidades_usadas = no_unidades_usadas+@cantidad where  pl = @pl or id_insumo = @idinsumo;
            end        
        ');
        /*DB::unprepared('
            CREATE TRIGGER tr_disminuirSaldo AFTER INSERT ON bodegas_egresos_detalles
            FOR EACH ROW BEGIN 
                UPDATE bodegas SET saldo = saldo - NEW.no_unidades WHERE bodegas.id = NEW.id_insumo;                
            END 
        ');
        DB::unprepared('
            CREATE TRIGGER tr_aumentarUsado AFTER INSERT ON bodegas_egresos_detalles
            FOR EACH ROW BEGIN 
                UDPATE bodegas_ingresos_detalles SET no_unidades_usadas = no_unidades_usadas + NEW.no_unidades WHERE bodegas_ingresos_detalles.pl = NEW.pl;
            END 
        ');*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER "tr_disminuirSaldo"');
        /*DB::unprepared('DROP TRIGGER "tr_aumentarUsado"');*/
    }
};
