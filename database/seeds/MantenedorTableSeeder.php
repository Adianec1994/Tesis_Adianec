<?php

use Illuminate\Database\Seeder;

class MantenedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mantenedores_externos')->insert(['nombre'=>'MCV',
            'numeroContrato'=>'1309','fechaInicio'=>'2019-01-10','fechaFin'=>'2020-01-10']);
    }
}
