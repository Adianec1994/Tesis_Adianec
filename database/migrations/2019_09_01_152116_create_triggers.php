<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            create procedure update_potencia_instalada (IN id INTEGER, IN tbl text)
                begin
                    declare potencia double;
                    if tbl = "grupos" then
                    select sum(potInstalada) into potencia from grupos where baterias_id = id;
                    update baterias set potInstalada = potencia where baterias.id = id;

                    elseif tbl = "baterias" then
                        select sum(potInstalada) into potencia from baterias where central_electricas_id = id;
                        update central_electricas set potInstalada = potencia where central_electricas.id = id;

                    elseif tbl = "central_electricas" then
                        select sum(potInstalada) into potencia from central_electricas where entidads_id = id;
                        update entidads set potInstalada = potencia where entidads.id = id;

                    end if;

                end;
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_baterias_after_insert
            after insert on grupos for each row call update_potencia_instalada(NEW.baterias_id, "grupos");
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_baterias_after_update
            after update on grupos for each row call update_potencia_instalada(NEW.baterias_id, "grupos");
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_baterias_after_delete
            after delete on grupos for each row call update_potencia_instalada(OLD.baterias_id, "grupos");
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_ce_after_update
            after update on baterias for each row call update_potencia_instalada(NEW.central_electricas_id, "baterias");
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_ce_after_delete
            after delete on baterias for each row call update_potencia_instalada(OLD.central_electricas_id, "baterias");
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_entidads_after_update
            after update on central_electricas for each row call update_potencia_instalada(NEW.entidads_id, "central_electricas");
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_entidads_after_delete
            after delete on central_electricas for each row call update_potencia_instalada(OLD.entidads_id, "central_electricas");
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getPdo()->exec("
        DROP procedure update_potencia_instalada;
        ");
    }
}
