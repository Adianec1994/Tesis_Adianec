<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentralElectricasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'central_electricas';

    /**
     * Run the migrations.
     * @table central_electricas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45)->nullable();
            $table->double('potInstalada')->default(0);
            $table->unsignedInteger('entidads_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["entidads_id"], 'fk_central_electricas_entidads1_idx');


            $table->foreign('entidads_id', 'fk_central_electricas_entidads1_idx')
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
