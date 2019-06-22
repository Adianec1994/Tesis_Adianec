<?php

namespace App\Policies;

use App\User;
use App\HechosExtraordinarios;
use Illuminate\Auth\Access\HandlesAuthorization;

class HechosExtraordinariosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the hechos extraordinarios.
     *
     * @param  \App\User  $user
     * @param  \App\HechosExtraordinarios  $hechosExtraordinarios
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_hecho_extraordinario');
    }

    /**
     * Determine whether the user can create hechos extraordinarios.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_hecho_extraordinario');
    }

    /**
     * Determine whether the user can update the hechos extraordinarios.
     *
     * @param  \App\User  $user
     * @param  \App\HechosExtraordinarios  $hechosExtraordinarios
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_hecho_extraordinario');
    }

    /**
     * Determine whether the user can delete the hechos extraordinarios.
     *
     * @param  \App\User  $user
     * @param  \App\HechosExtraordinarios  $hechosExtraordinarios
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_hecho_extraordinario');
    }

    /**
     * Determine whether the user can restore the hechos extraordinarios.
     *
     * @param  \App\User  $user
     * @param  \App\HechosExtraordinarios  $hechosExtraordinarios
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the hechos extraordinarios.
     *
     * @param  \App\User  $user
     * @param  \App\HechosExtraordinarios  $hechosExtraordinarios
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
