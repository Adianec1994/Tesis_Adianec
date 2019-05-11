<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlangeneracionsTable extends Migration
{
    /**
     * Run the migrations.
     * @table planGeneracions
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('planGeneracions')) {
            Schema::create('planGeneracions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->double('plan')->nullable();
                $table->integer('entidads_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["entidads_id"], 'fk_planGeneracions_entidads1_idx');


                $table->foreign('entidads_id', 'fk_planGeneracions_entidads1_idx')
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
       Schema::dropIfExists('planGeneracions');
     }
}
