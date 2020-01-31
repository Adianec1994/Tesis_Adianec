<?php

use Illuminate\Database\Seeder;

class BrigadaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brigadas')->insert(['numero'=>'1','cantidadTrabajadores'=>'10']);
        DB::table('brigadas')->insert(['numero'=>'2','cantidadTrabajadores'=>'8']);
        DB::table('brigadas')->insert(['numero'=>'6','cantidadTrabajadores'=>'12']);
    }
}
