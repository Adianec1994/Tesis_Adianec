<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('cargo');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('password');

                $table->integer('rol_users_id')->unsigned();
                $table->integer('entidads_id')->unsigned();
                $table->integer('img_users_id')->unsigned();
                $table->softDeletes();
                $table->rememberToken();
                $table->timestamps();

                // $table->index(["img_users_id"], 'fk_users_img_users1_idx');

                // $table->index(["rol_users_id"], 'fk_users_rol_users1_idx');

                // $table->index(["entidads_id"], 'fk_users_entidads1_idx');


                // $table->foreign('rol_users_id', 'fk_users_rol_users1_idx')
                    // ->references('id')->on('rol_users');

                // $table->foreign('entidads_id', 'fk_users_entidads1_idx')
                    // ->references('id')->on('entidads');

                // $table->foreign('img_users_id', 'fk_users_img_users1_idx')
                    // ->references('id')->on('img_users');
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
        Schema::dropIfExists('users');
    }
}
