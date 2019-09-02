<?php

namespace App\Policies;

use App\User;
use App\CentralElectrica;
use Illuminate\Auth\Access\HandlesAuthorization;

class CentralElectricaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the central electrica.
     *
     * @param  \App\User  $user
     * @param  \App\CentralElectrica  $centralElectrica
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_central');
    }

    /**
     * Determine whether the user can create central electricas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_central');
    }

    /**
     * Determine whether the user can update the central electrica.
     *
     * @param  \App\User  $user
     * @param  \App\CentralElectrica  $centralElectrica
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_central');
    }

    /**
     * Determine whether the user can delete the central electrica.
     *
     * @param  \App\User  $user
     * @param  \App\CentralElectrica  $centralElectrica
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_central');
    }

    /**
     * Determine whether the user can restore the central electrica.
     *
     * @param  \App\User  $user
     * @param  \App\CentralElectrica  $centralElectrica
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the central electrica.
     *
     * @param  \App\User  $user
     * @param  \App\CentralElectrica  $centralElectrica
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
