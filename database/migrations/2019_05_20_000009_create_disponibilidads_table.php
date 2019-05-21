<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilidadsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'disponibilidads';

    /**
     * Run the migrations.
     * @table disponibilidads
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->double('potInstaladaReal')->nullable();
            $table->double('potDisponibleReal')->nullable();
            $table->integer('entidads_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->index(["entidads_id"], 'fk_disponibilidads_entidads1_idx');


            $table->foreign('entidads_id', 'fk_disponibilidads_entidads1_idx')
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
