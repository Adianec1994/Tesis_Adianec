<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHechosExtraordinariosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'hechos_extraordinarios';

    /**
     * Run the migrations.
     * @table hechos_extraordinarios
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo', 45)->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('medidas')->nullable();
            $table->string('nombreImplicado', 45)->nullable();
            $table->string('nombreInforma', 45)->nullable();
            $table->integer('entidads_id')->unsigned();

            $table->index(["entidads_id"], 'fk_hechos_Extraordinarios_entidads1_idx');


            $table->foreign('entidads_id', 'fk_hechos_Extraordinarios_entidads1_idx')
                ->references('id')->on('entidads')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
