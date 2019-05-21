<?php

use Illuminate\Database\Seeder;

class EntidadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entidads')->insert(['nombre'=>'Geysel',
        'potInstalada'=>20,'ip'=>'10.0.0.1','provincias_id'=>1]);
    }
}
