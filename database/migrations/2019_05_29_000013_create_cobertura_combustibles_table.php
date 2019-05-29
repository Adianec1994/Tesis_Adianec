<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoberturaCombustiblesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cobertura_combustibles';

    /**
     * Run the migrations.
     * @table cobertura_combustibles
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->double('planReserva')->nullable();
            $table->double('fondaje')->nullable();
            $table->double('existOperativa')->nullable();
            $table->time('coberturaHoras')->nullable();
            $table->double('consumo')->nullable();
            $table->double('suminCupet')->nullable();
            $table->double('capacTotalAlmac')->nullable();
            $table->double('capacVacio')->nullable();
            $table->double('existTotalDiaAnterior')->nullable();
            $table->unsignedInteger('central_electricas_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["central_electricas_id"], 'fk_coberturas_central_electricas1_idx');


            $table->foreign('central_electricas_id', 'fk_coberturas_central_electricas1_idx')
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
