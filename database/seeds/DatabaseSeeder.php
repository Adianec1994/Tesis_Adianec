<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ProvinciaTableSeeder::class);
        $this->call(EntidadTableSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
