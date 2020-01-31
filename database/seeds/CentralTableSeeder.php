<?php

use Illuminate\Database\Seeder;

class CentralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('central_electricas')->insert(['nombre'=>'Berroa',
            'entidads_id'=>1]);
        DB::table('central_electricas')->insert(['nombre'=>'Naval',
            'entidads_id'=>1]);

        DB::table('central_electricas')->insert(['nombre'=>'Colón',
            'entidads_id'=>2]);
        DB::table('central_electricas')->insert(['nombre'=>'Jovellanos',
            'entidads_id'=>2]);

        DB::table('central_electricas')->insert(['nombre'=>'Remedios',
            'entidads_id'=>3]);

        DB::table('central_electricas')->insert(['nombre'=>'Cruces',
            'entidads_id'=>4]);
    }
}
