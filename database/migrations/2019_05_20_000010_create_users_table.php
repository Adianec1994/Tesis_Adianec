<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->string('cargo', 45)->nullable();
            $table->string('username', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('password', 45)->nullable();
            $table->string('imagen', 45)->nullable();
            $table->integer('entidads_id')->unsigned();

            $table->index(["entidads_id"], 'fk_users_entidads1_idx');

            $table->unique(["username"], 'username_UNIQUE');

            $table->unique(["email"], 'email_UNIQUE');


            $table->foreign('entidads_id', 'fk_users_entidads1_idx')
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
