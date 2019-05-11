<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('rol_users')) {
            Schema::create('rol_users', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('especialistaUeb')->default(false);
                $table->boolean('directorCd')->default(false);
                $table->boolean('directorUeb')->default(false);
                $table->boolean('especialistaEmpresa')->default(false);
                $table->boolean('directorCdn')->default(false);
                $table->boolean('directorGeneral')->default(false);
                $table->boolean('adminSys')->default(false);
                $table->boolean('new_usuario')->default(false);
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
        Schema::dropIfExists('rol_users');
    }
}
