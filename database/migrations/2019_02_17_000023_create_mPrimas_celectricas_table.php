<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMprimasCelectricasTable extends Migration
{
    /**
     * Run the migrations.
     * @table mPrimas_celectricas
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mPrimas_celectricas')) {
            Schema::create('mPrimas_celectricas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('materiasPrimas_id')->unsigned();
                $table->integer('central_electricas_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["materiasPrimas_id"], 'fk_mPrimas_celectricas_materiasPrimas1_idx');

                $table->index(["central_electricas_id"], 'fk_mPrimas_celectricas_central_electricas1_idx');


                $table->foreign('central_electricas_id', 'fk_mPrimas_celectricas_central_electricas1_idx')
                    ->references('id')->on('central_electricas')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('materiasPrimas_id', 'fk_mPrimas_celectricas_materiasPrimas1_idx')
                    ->references('id')->on('materiasPrimas')
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
       Schema::dropIfExists('mPrimas_celectricas');
     }
}
