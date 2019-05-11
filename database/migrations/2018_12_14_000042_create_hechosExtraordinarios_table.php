<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHechosextraordinariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hechosExtraordinarios')) {
            Schema::create('hechosExtraordinarios', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('tipo', 45)->nullable();
                $table->date('fecha')->nullable();
                $table->time('hora')->nullable();
                $table->text('descripcion')->nullable();
                $table->text('medidas')->nullable();
                $table->string('nombreImplicado',45)->nullable();
                $table->string('nombreInforma',45)->nullable();
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
        Schema::dropIfExists('hechosExtraordinarios');
    }
}
