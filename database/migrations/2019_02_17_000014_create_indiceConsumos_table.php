<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndiceconsumosTable extends Migration
{
    /**
     * Run the migrations.
     * @table indiceConsumos
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('indiceConsumos')) {
            Schema::create('indiceConsumos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->double('planCombustible')->nullable();
                $table->integer('entidads_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["entidads_id"], 'fk_indiceConsumos_entidads1_idx');


                $table->foreign('entidads_id', 'fk_indiceConsumos_entidads1_idx')
                    ->references('id')->on('entidads')
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
       Schema::dropIfExists('indiceConsumos');
     }
}
