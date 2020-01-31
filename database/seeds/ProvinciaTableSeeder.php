<?php

use Illuminate\Database\Seeder;

class ProvinciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provincias')->insert(['nombre'=>'La Habana']);
        DB::table('provincias')->insert(['nombre'=>'Matanzas']);
        DB::table('provincias')->insert(['nombre'=>'Villa Clara']);
        DB::table('provincias')->insert(['nombre'=>'Pinar del Río']);
        DB::table('provincias')->insert(['nombre'=>'Cienfuegos']);
        DB::table('provincias')->insert(['nombre'=>'Camaguey']);
        DB::table('provincias')->insert(['nombre'=>'Granma']);
    }
}
