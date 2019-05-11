<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosdiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('eventosDiarios')) {
            Schema::create('eventosDiarios', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('estado', 45)->nullable();
                $table->dateTime('fEvento')->nullable();
                $table->dateTime('fPosSolucion')->nullable();
                $table->dateTime('fReporte')->nullable();
                $table->dateTime('fDiagnostico')->nullable();
                $table->dateTime('fSolucion')->nullable();
                $table->integer('horas')->nullable();
                $table->text('sistema')->nullable();
                $table->text('subSistema')->nullable();
                $table->text('parte')->nullable();
                $table->text('fallo')->nullable();
                $table->text('diagnosticoPreliminar')->nullable();
                $table->text('diagnostico')->nullable();
                $table->string('responsable', 45)->nullable();
                $table->string('insertadoPor', 45)->nullable();
                $table->integer('grupos_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["grupos_id"], 'fk_eventosDiarios_grupos1_idx');


                $table->foreign('grupos_id', 'fk_eventosDiarios_grupos1_idx')
                    ->references('id')->on('grupos')
                    ->onDelete('no action')
                    ->onUpdate('no action');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventosDiarios');
    }
}
