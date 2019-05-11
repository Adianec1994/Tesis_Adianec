<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('datosGenerales')) {
            Schema::create('datosGenerales', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->double('genBruta')->default(0);
                $table->double('insumos')->default(0);
                $table->double('recibido')->default(0);
                $table->double('volumenRecibido')->default(0);
                $table->double('consumoGeneracion')->default(0);
                $table->double('densidadPonderada')->default(0);
                $table->double('temperatura')->default(0);
                $table->double('densidadCorreccion')->default(0);
                $table->double('valorCalorico')->default(0);
                $table->double('existencia')->default(0);
                $table->double('cobertura')->default(0);
                $table->double('indiceConsumo')->default(0);
                $table->double('lubricteRecibido')->default(0);
                $table->double('lubricteCsmoReposicion')->default(0);
                $table->double('lubricteCsmoCambio')->default(0);
                $table->double('lubricteCsmoTotal')->default(0);
                $table->double('lubricteExistencia')->default(0);
                $table->double('lubricteCobertura')->default(0);
                $table->double('lubricteIndiceCsmo')->default(0);
                $table->double('refrigteRecibido')->default(0);
                $table->double('refrigteConsumo')->default(0);
                $table->double('refrigteExistencia')->default(0);
                $table->integer('central_electricas_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["central_electricas_id"], 'fk_datosGenerales_central_electricas1_idx');


                $table->foreign('central_electricas_id', 'fk_datosGenerales_central_electricas1_idx')
                    ->references('id')->on('central_electricas')
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
        Schema::dropIfExists('datosGenerales');
    }
}
