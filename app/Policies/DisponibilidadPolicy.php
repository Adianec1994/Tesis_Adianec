<?php

namespace App\Policies;

use App\User;
use App\Disponibilidad;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisponibilidadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the disponibilidad.
     *
     * @param  \App\User  $user
     * @param  \App\Disponibilidad  $disponibilidad
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_disponibilidad');
    }

    /**
     * Determine whether the user can create disponibilidads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_disponibilidad');
    }

    /**
     * Determine whether the user can update the disponibilidad.
     *
     * @param  \App\User  $user
     * @param  \App\Disponibilidad  $disponibilidad
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_disponibilidad');
    }

    /**
     * Determine whether the user can delete the disponibilidad.
     *
     * @param  \App\User  $user
     * @param  \App\Disponibilidad  $disponibilidad
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_disponibilidad');
    }

    /**
     * Determine whether the user can restore the disponibilidad.
     *
     * @param  \App\User  $user
     * @param  \App\Disponibilidad  $disponibilidad
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the disponibilidad.
     *
     * @param  \App\User  $user
     * @param  \App\Disponibilidad  $disponibilidad
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
