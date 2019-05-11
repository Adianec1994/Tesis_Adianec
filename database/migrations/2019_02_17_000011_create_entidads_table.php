<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('entidads')) {
            Schema::create('entidads', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombre',45)->nullable();
                $table->double('potInstalada')->nullable();
                $table->integer('provincias_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["provincias_id"], 'fk_entidads_provincias1_idx');


                $table->foreign('provincias_id', 'fk_entidads_provincias1_idx')
                    ->references('id')->on('provincias')
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
        Schema::dropIfExists('entidads');
    }
}
