<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('grupos')) {
            Schema::create('grupos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('numero')->nullable();
                $table->double('potInstalada')->nullable();
                $table->integer('baterias_id')->unsigned();
                $table->integer('proveedors_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["proveedors_id"], 'fk_grupos_proveedors1_idx');

                $table->index(["baterias_id"], 'fk_grupos_baterias1_idx');


                $table->foreign('baterias_id', 'fk_grupos_baterias1_idx')
                    ->references('id')->on('baterias')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('proveedors_id', 'fk_grupos_proveedors1_idx')
                    ->references('id')->on('proveedors')
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
        Schema::dropIfExists('grupos');
    }
}
