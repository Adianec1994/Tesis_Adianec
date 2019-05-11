<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     * @table grupos_mantenimientos
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('grupos_mantenimientos')) {
            Schema::create('grupos_mantenimientos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('grupos_id')->unsigned();
                $table->integer('mantenimientos_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["grupos_id"], 'fk_grupos_mantenimientos_grupos1_idx');

                $table->index(["mantenimientos_id"], 'fk_grupos_mantenimientos_mantenimientos1_idx');


                $table->foreign('grupos_id', 'fk_grupos_mantenimientos_grupos1_idx')
                    ->references('id')->on('grupos')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('mantenimientos_id', 'fk_grupos_mantenimientos_mantenimientos1_idx')
                    ->references('id')->on('mantenimientos')
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
       Schema::dropIfExists('grupos_mantenimientos');
     }
}
