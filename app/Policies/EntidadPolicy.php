<?php

namespace App\Policies;

use App\User;
use App\Entidad;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntidadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the entidad.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_entidad');
    }

    /**
     * Determine whether the user can create entidads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_entidad');
    }

    /**
     * Determine whether the user can update the entidad.
     *
     * @param  \App\User  $user
     * @param  \App\Entidad  $entidad
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_entidad');
    }

    /**
     * Determine whether the user can delete the entidad.
     *
     * @param  \App\User  $user
     * @param  \App\Entidad  $entidad
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_entidad');
    }

    /**
     * Determine whether the user can restore the entidad.
     *
     * @param  \App\User  $user
     * @param  \App\Entidad  $entidad
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the entidad.
     *
     * @param  \App\User  $user
     * @param  \App\Entidad  $entidad
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
