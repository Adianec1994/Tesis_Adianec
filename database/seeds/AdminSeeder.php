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
        $password=bcrypt('Admin2019*');
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@spd.cu',
            'password'=>$password,
            'cargo'=>'Administrador',
            'username'=>'admin',
            'accepted' => true,
            'entidads_id'=>1
            ]);

            $admin->assignRole(Role::whereName('Administrador')->get());
    }
}
