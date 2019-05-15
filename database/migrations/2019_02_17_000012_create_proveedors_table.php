<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'proveedors';

    /**
     * Run the migrations.
     * @table proveedors
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('proveedors')) {
            Schema::create('proveedors', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('marca', 8)->nullable();
                $table->integer('serie');
                $table->integer('paiss_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["paiss_id"], 'fk_proveedors_paiss1_idx');


                $table->foreign('paiss_id', 'fk_proveedors_paiss1_idx')
                    ->references('id')->on('paiss')
                    ->onDelete('no action')
                    ->onUpdate('no action');
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
       Schema::dropIfExists('proveedors');
     }
}
