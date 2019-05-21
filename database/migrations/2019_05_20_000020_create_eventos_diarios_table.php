<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosDiariosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'eventos_diarios';

    /**
     * Run the migrations.
     * @table eventos_diarios
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('estado', 45)->nullable();
            $table->dateTime('fechaEvento')->nullable();
            $table->dateTime('fechaPosibleSolucion')->nullable();
            $table->dateTime('fechaReporte')->nullable();
            $table->dateTime('fechaDiagnostico')->nullable();
            $table->dateTime('fechaSolucion')->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
