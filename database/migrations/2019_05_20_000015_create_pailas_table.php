<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePailasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pailas';

    /**
     * Run the migrations.
     * @table pailas
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
            $table->double('combustibleFactura')->nullable();
            $table->double('combustibleMedicion')->nullable();
            $table->text('acciones')->nullable();
            $table->integer('central_electricas_id')->unsigned();
            $table->integer('operadors_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->index(["operadors_id"], 'fk_pailas_operadors1_idx');

            $table->index(["central_electricas_id"], 'fk_pailas_central_electricas1_idx');


            $table->foreign('central_electricas_id', 'fk_pailas_central_electricas1_idx')
                ->references('id')->on('central_electricas')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('operadors_id', 'fk_pailas_operadors1_idx')
                ->references('id')->on('operadors')
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
