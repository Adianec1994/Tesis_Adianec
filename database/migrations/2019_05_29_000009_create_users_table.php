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
            $table->string('name', 45);
            $table->string('cargo', 45);
            $table->string('username', 45);
            $table->string('email', 45);
            $table->mediumText('password');
            $table->string('imagen', 45)->nullable();
            $table->boolean('accepted')->default(false);
            $table->unsignedInteger('entidads_id')->default(1);
            $table->softDeletes();
            $table->timestamps();

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
