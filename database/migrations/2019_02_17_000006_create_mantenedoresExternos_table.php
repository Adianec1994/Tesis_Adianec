<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenedoresexternosTable extends Migration
{
    /**
     * Run the migrations.
     * @table mantenedoresExternos
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('mantenedoresExternos')) {
            Schema::create('mantenedoresExternos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombre', 45)->nullable();
                $table->integer('numeroContrato')->nullable();
                $table->date('fechaInicio')->nullable();
                $table->date('fechaFin')->nullable();
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
       Schema::dropIfExists('mantenedoresExternos');
     }
}
