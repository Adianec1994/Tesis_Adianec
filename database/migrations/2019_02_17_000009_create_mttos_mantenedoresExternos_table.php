<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMttosMantenedoresexternosTable extends Migration
{
    /**
     * Run the migrations.
     * @table mttos_mantenedoresExternos
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mttos_mantenedoresExternos')) {
            Schema::create('mttos_mantenedoresExternos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('mantenimientos_id')->unsigned();
                $table->integer('mantenedoresExternos_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["mantenimientos_id"], 'fk_mttos_mantenedoresExternos_mantenimientos1_idx');

                $table->index(["mantenedoresExternos_id"], 'fk_mttos_mantenedoresExternos_mantenedoresExternos1_idx');


                $table->foreign('mantenedoresExternos_id', 'fk_mttos_mantenedoresExternos_mantenedoresExternos1_idx')
                    ->references('id')->on('mantenedoresExternos')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('mantenimientos_id', 'fk_mttos_mantenedoresExternos_mantenimientos1_idx')
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
       Schema::dropIfExists('mttos_mantenedoresExternos');
     }
}
