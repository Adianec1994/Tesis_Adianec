<?php

namespace App\Policies;

use App\User;
use App\Pailas;
use Illuminate\Auth\Access\HandlesAuthorization;

class PailasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pailas.
     *
     * @param  \App\User  $user
     * @param  \App\Pailas  $pailas
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_paila');
    }

    /**
     * Determine whether the user can create pailas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_paila');
    }

    /**
     * Determine whether the user can update the pailas.
     *
     * @param  \App\User  $user
     * @param  \App\Pailas  $pailas
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_paila');
    }

    /**
     * Determine whether the user can delete the pailas.
     *
     * @param  \App\User  $user
     * @param  \App\Pailas  $pailas
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_paila');
    }

    /**
     * Determine whether the user can restore the pailas.
     *
     * @param  \App\User  $user
     * @param  \App\Pailas  $pailas
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the pailas.
     *
     * @param  \App\User  $user
     * @param  \App\Pailas  $pailas
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
