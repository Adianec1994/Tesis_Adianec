<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     * @table disponibilidads
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('disponibilidads')) {
            Schema::create('disponibilidads', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->date('fecha')->nullable();
                $table->double('potInstaladaReal')->nullable();
                $table->double('potDisponibleReal')->nullable();
                $table->double('factor')->nullable();
                $table->integer('entidads_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["entidads_id"], 'fk_disponibilidads_entidads1_idx');


                $table->foreign('entidads_id', 'fk_disponibilidads_entidads1_idx')
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
       Schema::dropIfExists('disponibilidads');
     }
}
