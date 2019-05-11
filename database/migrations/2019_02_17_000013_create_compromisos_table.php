<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompromisosTable extends Migration
{
    /**
     * Run the migrations.
     * @table compromisos
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('compromisos')) {
            Schema::create('compromisos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->double('planMensual')->nullable();
                $table->integer('entidads_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["entidads_id"], 'fk_compromisos_entidads1_idx');


                $table->foreign('entidads_id', 'fk_compromisos_entidads1_idx')
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
       Schema::dropIfExists('compromisos');
     }
}
