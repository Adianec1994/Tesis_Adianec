<?php

namespace App\Policies;

use App\User;
use App\Generacion;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneracionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the generacion.
     *
     * @param  \App\User  $user
     * @param  \App\Generacion  $generacion
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_generacion');
    }

    /**
     * Determine whether the user can create generacions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_generacion');
    }

    /**
     * Determine whether the user can update the generacion.
     *
     * @param  \App\User  $user
     * @param  \App\Generacion  $generacion
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_generacion');
    }

    /**
     * Determine whether the user can delete the generacion.
     *
     * @param  \App\User  $user
     * @param  \App\Generacion  $generacion
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_generacion');
    }

    /**
     * Determine whether the user can restore the generacion.
     *
     * @param  \App\User  $user
     * @param  \App\Generacion  $generacion
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the generacion.
     *
     * @param  \App\User  $user
     * @param  \App\Generacion  $generacion
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
