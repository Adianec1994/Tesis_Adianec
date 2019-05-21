<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneracionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'generacions';

    /**
     * Run the migrations.
     * @table generacions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->time('horaEntrada')->nullable();
            $table->time('horaSalida')->nullable();
            $table->text('reportadoPor')->nullable();
            $table->time('tiempoOperacion')->nullable();
            $table->integer('grupos_id')->unsigned();

            $table->index(["grupos_id"], 'fk_generacions_grupos1_idx');


            $table->foreign('grupos_id', 'fk_generacions_grupos1_idx')
                ->references('id')->on('grupos')
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
