<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mantenimientos')) {
            Schema::create('mantenimientos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->date('fechaMtto')->nullable();
                $table->text('tipoTrabajo')->nullable();
                $table->time('horaEntrada')->nullable();
                $table->time('horaSalida')->nullable();
                $table->string('informa', 45)->nullable();
                $table->text('resultado')->nullable();
                $table->softDeletes();
                $table->timestamps();
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
        Schema::dropIfExists('mantenimientos');
    }
}
