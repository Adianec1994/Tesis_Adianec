<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'plans';

    /**
     * Run the migrations.
     * @table plans
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('mes', 45)->nullable();
            $table->decimal('generacion')->nullable();
            $table->decimal('indiceConsumoCombustible')->nullable();
            $table->decimal('compromiso')->nullable();
            $table->unsignedInteger('entidads_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index(["entidads_id"], 'fk_planGeneracions_entidads1_idx');


            $table->foreign('entidads_id', 'fk_planGeneracions_entidads1_idx')
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
