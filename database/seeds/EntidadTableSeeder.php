<?php

use Illuminate\Database\Seeder;

class EntidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('entidads')->insert(['nombre'=>'Geysel Habana',
            'potInstalada'=>20,'ip'=>'10.0.0.1','provincias_id'=>1]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Matanzas',
            'potInstalada'=>18,'ip'=>'10.0.0.2','provincias_id'=>2]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Villa Clara',
            'potInstalada'=>15,'ip'=>'10.0.0.3','provincias_id'=>3]);
    }
}
