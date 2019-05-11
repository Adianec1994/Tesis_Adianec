<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChofersTable extends Migration
{
    /**
     * Run the migrations.
     * @table chofers
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('chofers')) {
            Schema::create('chofers', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('nombrechofer', 45)->nullable();
                $table->bigInteger('ci_chofer');
                $table->string('nombreAcompte', 45)->nullable();
                $table->bigInteger('ci_acompte');
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
       Schema::dropIfExists('chofers');
     }
}
