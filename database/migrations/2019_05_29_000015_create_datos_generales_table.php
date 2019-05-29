<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosGeneralesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'datos_generales';

    /**
     * Run the migrations.
     * @table datos_generales
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('genBruta')->nullable();
            $table->double('insumos')->nullable();
            $table->double('recibido')->nullable();
            $table->double('volumenRecibido')->nullable();
            $table->double('consumoGeneracion')->nullable();
            $table->double('densidadPonderada')->nullable();
            $table->double('temperatura')->nullable();
            $table->double('densidadCorreccion')->nullable();
            $table->double('valorCalorico')->nullable();
            $table->double('existencia')->nullable();
            $table->double('cobertura')->nullable();
            $table->double('indiceConsumo')->nullable();
            $table->double('lubricteRecibido')->nullable();
            $table->double('lubricteCsmoReposicion')->nullable();
            $table->double('lubricteCsmoCambio')->nullable();
            $table->double('lubricteCsmoTotal')->nullable();
            $table->double('lubricteExistencia')->nullable();
            $table->double('lubricteCobertura')->nullable();
            $table->double('lubricteIndiceCsmo')->nullable();
            $table->double('refrigteRecibido')->nullable();
            $table->double('refrigteConsumo')->nullable();
            $table->double('refrigteExistencia')->nullable();
            $table->unsignedInteger('central_electricas_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["central_electricas_id"], 'fk_datosGenerales_central_electricas1_idx');


            $table->foreign('central_electricas_id', 'fk_datosGenerales_central_electricas1_idx')
                ->references('id')->on('central_electricas')
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
