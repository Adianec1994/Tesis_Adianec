<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaissTable extends Migration
{
    /**
     * Run the migrations.
     * @table paiss
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('paiss')) {
            Schema::create('paiss', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombre', 45)->nullable();
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
       Schema::dropIfExists('paiss');
     }
}
