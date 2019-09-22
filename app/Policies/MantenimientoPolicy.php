<?php

namespace App\Policies;

use App\User;
use App\Mantenimiento;
use Illuminate\Auth\Access\HandlesAuthorization;

class MantenimientoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mantenimiento.
     *
     * @param  \App\User  $user
     * @param  \App\Mantenimiento  $mantenimiento
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_mantenimiento');
    }

    /**
     * Determine whether the user can create mantenimiento.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_mantenimiento');
    }

    /**
     * Determine whether the user can update the mantenimiento.
     *
     * @param  \App\User  $user
     * @param  \App\Mantenimiento  $mantenimiento
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_mantenimiento');
    }

    /**
     * Determine whether the user can delete the mantenimiento.
     *
     * @param  \App\User  $user
     * @param  \App\Mantenimiento  $mantenimiento
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_mantenimiento');
    }

    /**
     * Determine whether the user can restore the mantenimiento.
     *
     * @param  \App\User  $user
     * @param  \App\Mantenimiento  $mantenimiento
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the mantenimiento.
     *
     * @param  \App\User  $user
     * @param  \App\Mantenimiento  $mantenimiento
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
