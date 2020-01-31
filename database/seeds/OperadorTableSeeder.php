<?php

use Illuminate\Database\Seeder;

class OperadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operadors')->insert(['nombre'=>'Juan Rodríguez Pérez',
            'cidentidad'=>'78051298743','ocupacion'=>'Operador']);
        DB::table('operadors')->insert(['nombre'=>'Pedro Alfonso González',
            'cidentidad'=>'67092363895','ocupacion'=>'Chofer']);
        DB::table('operadors')->insert(['nombre'=>'Fernando Suárez Lara',
            'cidentidad'=>'87102858934','ocupacion'=>'Acompañante']);
    }
}
