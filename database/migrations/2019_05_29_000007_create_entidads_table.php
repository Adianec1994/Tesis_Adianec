<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'entidads';

    /**
     * Run the migrations.
     * @table entidads
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45)->nullable();
            $table->double('potInstalada')->nullable();
            $table->string('ip', 45)->nullable();
            $table->unsignedInteger('provincias_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["provincias_id"], 'fk_entidads_provincias1_idx');


            $table->foreign('provincias_id', 'fk_entidads_provincias1_idx')
                ->references('id')->on('provincias')
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
