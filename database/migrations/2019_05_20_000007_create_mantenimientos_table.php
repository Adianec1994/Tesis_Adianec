<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mantenimientos';

    /**
     * Run the migrations.
     * @table mantenimientos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fechaMtto')->nullable();
            $table->text('tipoTrabajo')->nullable();
            $table->time('horaEntrada')->nullable();
            $table->time('horaSalida')->nullable();
            $table->string('informa', 45)->nullable();
            $table->text('resultado')->nullable();
            $table->integer('mantenedores_externos_id')->unsigned();
            $table->integer('brigadas_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->index(["mantenedores_externos_id"], 'fk_mantenimientos_mantenedores_externos1_idx');

            $table->index(["brigadas_id"], 'fk_mantenimientos_brigadas1_idx');


            $table->foreign('mantenedores_externos_id', 'fk_mantenimientos_mantenedores_externos1_idx')
                ->references('id')->on('mantenedores_externos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('brigadas_id', 'fk_mantenimientos_brigadas1_idx')
                ->references('id')->on('brigadas')
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
