<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Ejecutar primero la creacion de los datos de roles
        $this->call(UsersTableSeeder::class);

        //Generar previamente los roles que van a necesitar los usuarios
       // $this->call(UserTableSeeder::class);


    }
}
