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

        DB::connection()->getPdo()->exec("
        create procedure update_potencia_instalada_baterias (IN id INTEGER)
            begin
                declare potencia double;
                select sum(potInstalada) into potencia from grupos where baterias_id = id;
                update baterias set potInstalada = potencia where baterias.id = id;
            end;

        create procedure update_potencia_instalada_ce (IN id INTEGER)
            begin
                declare potencia double;
                select sum(potInstalada) into potencia from baterias where central_electricas_id = id;
                update central_electricas set potInstalada = potencia where central_electricas.id = id;
            end;

        create procedure update_potencia_instalada_entidads (IN id INTEGER)
            begin
                declare potencia double;
                select sum(potInstalada) into potencia from central_electricas where entidads_id = id;
                update entidads set potInstalada = potencia where entidads.id = id;
            end;
        ");


        DB::unprepared('
            create trigger update_potencia_instalada_baterias_after_insert
            after insert on grupos for each row call update_potencia_instalada_baterias(NEW.baterias_id);
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_baterias_after_update
            after update on grupos for each row call update_potencia_instalada_baterias(NEW.baterias_id);
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_baterias_after_delete
            after delete on grupos for each row call update_potencia_instalada_baterias(OLD.baterias_id);
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_ce_after_update
            after update on baterias for each row call update_potencia_instalada_ce(NEW.central_electricas_id);
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_ce_after_delete
            after delete on baterias for each row call update_potencia_instalada_ce(OLD.central_electricas_id);
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_entidads_after_update
            after update on central_electricas for each row call update_potencia_instalada_entidads(NEW.entidads_id);
        ');

        DB::unprepared('
            create trigger update_potencia_instalada_entidads_after_delete
            after delete on central_electricas for each row call update_potencia_instalada_entidads(OLD.entidads_id);
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
        DROP procedure update_potencia_instalada_baterias;
        DROP procedure update_potencia_instalada_ce;
        DROP procedure update_potencia_instalada_entidads;
        ");
    }
}
