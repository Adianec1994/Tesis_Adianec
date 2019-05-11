<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoberturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('coberturas')) {
            Schema::create('coberturas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->date('fecha')->nullable();
                $table->double('planReserva')->nullable();
                $table->double('fondaje')->nullable();
                $table->double('existOperativa')->nullable();
                $table->double('coberturaHoras')->nullable();
                $table->double('consumo')->nullable();
                $table->double('suminCupet')->nullable();
                $table->double('capacTotalAlmac')->nullable();
                $table->double('capacVacio')->nullable();
                $table->double('existTotalDiaAnterior')->nullable();
                $table->integer('central_electricas_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["central_electricas_id"], 'fk_coberturas_central_electricas1_idx');


                $table->foreign('central_electricas_id', 'fk_coberturas_central_electricas1_idx')
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
        Schema::dropIfExists('coberturas');
    }
}
