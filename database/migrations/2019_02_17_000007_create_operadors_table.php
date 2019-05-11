<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperadorsTable extends Migration
{
    /**
     * Run the migrations.
     * @table operadors
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('operadors')) {
            Schema::create('operadors', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombre', 45)->nullable();
                $table->bigInteger('cidentidad');
                $table->softDeletes();
                $table->timestamps();
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
       Schema::dropIfExists('operadors');
     }
}
