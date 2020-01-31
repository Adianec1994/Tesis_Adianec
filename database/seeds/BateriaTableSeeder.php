<?php

use Illuminate\Database\Seeder;

class BateriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('baterias')->insert(['numero'=>'1',
            'central_electricas_id'=>1]);
        DB::table('baterias')->insert(['numero'=>'2',
            'central_electricas_id'=>1]);

        DB::table('baterias')->insert(['numero'=>'1',
            'central_electricas_id'=>2]);

        DB::table('baterias')->insert(['numero'=>'5',
            'central_electricas_id'=>3]);

        DB::table('baterias')->insert(['numero'=>'4',
            'central_electricas_id'=>4]);
        DB::table('baterias')->insert(['numero'=>'3',
            'central_electricas_id'=>4]);
    }
}
