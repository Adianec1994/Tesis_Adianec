<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'grupos';

    /**
     * Run the migrations.
     * @table grupos
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
            $table->integer('baterias_id')->unsigned();
            $table->integer('proveedors_id')->unsigned();

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
