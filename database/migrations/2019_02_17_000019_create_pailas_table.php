<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePailasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pailas')) {
            Schema::create('pailas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->date('fecha')->nullable();
                $table->time('hora')->nullable();
                $table->double('comb_factura')->nullable();
                $table->double('comb_medicion')->nullable();
                $table->text('acciones')->nullable();
                $table->integer('central_electricas_id')->unsigned();
                $table->integer('chofers_id')->unsigned();
                $table->integer('operadors_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["chofers_id"], 'fk_pailas_chofers1_idx');

                $table->index(["operadors_id"], 'fk_pailas_operadors1_idx');

                $table->index(["central_electricas_id"], 'fk_pailas_central_electricas1_idx');


                $table->foreign('central_electricas_id', 'fk_pailas_central_electricas1_idx')
                    ->references('id')->on('central_electricas')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('chofers_id', 'fk_pailas_chofers1_idx')
                    ->references('id')->on('chofers')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('operadors_id', 'fk_pailas_operadors1_idx')
                    ->references('id')->on('operadors')
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
        Schema::dropIfExists('pailas');
    }
}
