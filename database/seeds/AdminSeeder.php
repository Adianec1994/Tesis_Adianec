<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('Admin2019*');
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@geysel.cu',
            'password' => $password,
            'cargo' => 'Administrador',
            'username' => 'admin',
            'accepted' => true,
            'entidads_id' => 1
        ]);

        $admin->assignRole(Role::whereName('Desarrollo')->get());

        $password = bcrypt('Admin2019*');
        $adianec = User::create([
            'name' => 'Adianec',
            'email' => 'adianec@geysel.cu',
            'password' => $password,
            'cargo' => 'Especialista CDN',
            'username' => 'adianec',
            'accepted' => true,
            'entidads_id' => 1
        ]);

        $adianec->assignRole(Role::whereName('Especialista CDN')->get());

        $password = bcrypt('Admin2019*');
        $directorcd = User::create([
            'name' => 'DirectorCD',
            'email' => 'directorcd@geysel.cu',
            'password' => $password,
            'cargo' => 'Director CDN',
            'username' => 'directorcd',
            'accepted' => true,
            'entidads_id' => 1
        ]);

        $directorcd->assignRole(Role::whereName('Director CDN')->get());
    }
}
