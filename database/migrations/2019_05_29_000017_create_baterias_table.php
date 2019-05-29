<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBateriasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'baterias';

    /**
     * Run the migrations.
     * @table baterias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('numero')->nullable();
            $table->double('potInstalada')->nullable();
            $table->unsignedInteger('central_electricas_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["central_electricas_id"], 'fk_baterias_central_electricas1_idx');


            $table->foreign('central_electricas_id', 'fk_baterias_central_electricas1_idx')
                ->references('id')->on('central_electricas')
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
