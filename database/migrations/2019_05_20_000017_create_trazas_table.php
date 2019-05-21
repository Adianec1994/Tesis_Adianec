<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrazasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'trazas';

    /**
     * Run the migrations.
     * @table trazas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('accion', 45)->nullable();
            $table->string('ip', 45)->nullable();
            $table->integer('users_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->index(["users_id"], 'fk_trazas_users1_idx');


            $table->foreign('users_id', 'fk_trazas_users1_idx')
                ->references('id')->on('users')
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
