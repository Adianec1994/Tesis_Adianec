<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrigadasTable extends Migration
{
    /**
     * Run the migrations.
     * @table brigadas
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('brigadas')) {
            Schema::create('brigadas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('numero')->nullable();
                $table->integer('cantidadTrabajadores')->nullable();
                $table->softDeletes();
                $table->timestamps();
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
       Schema::dropIfExists('brigadas');
     }
}
