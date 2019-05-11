<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneracionsTable extends Migration
{
    /**
     * Run the migrations.
     * @table generacions
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('generacions')) {
            Schema::create('generacions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->date('fecha')->nullable();
                $table->time('hEntradaAM')->nullable();
                $table->time('hSalidaAM')->nullable();
                $table->time('hEntradaM')->nullable();
                $table->time('hSalidaM')->nullable();
                $table->time('hEntradaPM')->nullable();
                $table->time('hSalidaPM')->nullable();
                $table->text('reporta')->nullable();
                $table->time('tiempoOperacion')->nullable();
                $table->integer('grupos_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["grupos_id"], 'fk_generacions_grupos1_idx');


                $table->foreign('grupos_id', 'fk_generacions_grupos1_idx')
                    ->references('id')->on('grupos')
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
       Schema::dropIfExists('generacions');
     }
}
