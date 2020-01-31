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
            'ip'=>'10.0.0.1','provincias_id'=>1]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Matanzas',
            'ip'=>'10.0.0.2','provincias_id'=>2]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Villa Clara',
            'ip'=>'10.0.0.3','provincias_id'=>3]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Cienfuegos',
            'ip'=>'10.0.0.4','provincias_id'=>4]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Pinar del Río',
            'ip'=>'10.0.0.5','provincias_id'=>5]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Camaguey',
            'ip'=>'10.0.0.6','provincias_id'=>6]);
            DB::table('entidads')->insert(['nombre'=>'Geysel Granma',
            'ip'=>'10.0.0.7','provincias_id'=>7]);
    }
}
