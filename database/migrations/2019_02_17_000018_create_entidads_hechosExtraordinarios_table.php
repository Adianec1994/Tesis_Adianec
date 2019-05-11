<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadsHechosextraordinariosTable extends Migration
{
    /**
     * Run the migrations.
     * @table entidads_hechosExtraordinarios
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('entidads_hechosExtraordinarios')) {
            Schema::create('entidads_hechosExtraordinarios', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('entidads_id')->unsigned();
                $table->integer('hechosExtraordinarios_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["entidads_id"], 'fk_entidads_hechosExtraordinarios_entidads1_idx');

                $table->index(["hechosExtraordinarios_id"], 'fk_entidads_hechosExtraordinarios_hechosExtraordinarios1_idx');


                $table->foreign('entidads_id', 'fk_entidads_hechosExtraordinarios_entidads1_idx')
                    ->references('id')->on('entidads')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('hechosExtraordinarios_id', 'fk_entidads_hechosExtraordinarios_hechosExtraordinarios1_idx')
                    ->references('id')->on('hechosExtraordinarios')
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
       Schema::dropIfExists('entidads_hechosExtraordinarios');
     }
}
