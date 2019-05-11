<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrigadasMttosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'brigadas_mttos';

    /**
     * Run the migrations.
     * @table brigadas_mttos
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('brigadas_mttos')) {
            Schema::create('brigadas_mttos', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('brigadas_id')->unsigned();
                $table->integer('mantenimientos_id')->unsigned();
                $table->softDeletes();
                $table->timestamps();

                $table->index(["brigadas_id"], 'fk_brigadas_mttos_brigadas1_idx');

                $table->index(["mantenimientos_id"], 'fk_brigadas_mttos_mantenimientos1_idx');


                $table->foreign('brigadas_id', 'fk_brigadas_mttos_brigadas1_idx')
                    ->references('id')->on('brigadas')
                    ->onDelete('no action')
                    ->onUpdate('no action');

                $table->foreign('mantenimientos_id', 'fk_brigadas_mttos_mantenimientos1_idx')
                    ->references('id')->on('mantenimientos')
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
       Schema::dropIfExists('brigadas_mttos');
     }
}
