<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentralElectricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('central_electricas')) {
            Schema::create('central_electricas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombre',45)->nullable();
                $table->double('potInstalada')->nullable();
                $table->integer('entidads_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["entidads_id"], 'fk_central_electricas_entidads1_idx');


                $table->foreign('entidads_id', 'fk_central_electricas_entidads1_idx')
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
        Schema::dropIfExists('central_electricas');
    }
}
