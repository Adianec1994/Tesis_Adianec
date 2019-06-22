<?php

namespace App\Policies;

use App\User;
use App\DatosGenerales;
use Illuminate\Auth\Access\HandlesAuthorization;

class DatosGeneralesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the datos generales.
     *
     * @param  \App\User  $user
     * @param  \App\DatosGenerales  $datosGenerales
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_dato_general');
    }

    /**
     * Determine whether the user can create datos generales.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_dato_general');
    }

    /**
     * Determine whether the user can update the datos generales.
     *
     * @param  \App\User  $user
     * @param  \App\DatosGenerales  $datosGenerales
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_dato_general');
    }

    /**
     * Determine whether the user can delete the datos generales.
     *
     * @param  \App\User  $user
     * @param  \App\DatosGenerales  $datosGenerales
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_dato_general');
    }

    /**
     * Determine whether the user can restore the datos generales.
     *
     * @param  \App\User  $user
     * @param  \App\DatosGenerales  $datosGenerales
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the datos generales.
     *
     * @param  \App\User  $user
     * @param  \App\DatosGenerales  $datosGenerales
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
