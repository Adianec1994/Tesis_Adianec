<?php

namespace App\Policies;

use App\User;
use App\Baterias;
use Illuminate\Auth\Access\HandlesAuthorization;

class BateriaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the baterias.
     *
     * @param  \App\User  $user
     * @param  \App\Baterias  $baterias
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_bateria');
    }

    /**
     * Determine whether the user can create baterias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_bateria');
    }

    /**
     * Determine whether the user can update the baterias.
     *
     * @param  \App\User  $user
     * @param  \App\Baterias  $baterias
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_bateria');
    }

    /**
     * Determine whether the user can delete the baterias.
     *
     * @param  \App\User  $user
     * @param  \App\Baterias  $baterias
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_bateria');
    }

    /**
     * Determine whether the user can restore the baterias.
     *
     * @param  \App\User  $user
     * @param  \App\Baterias  $baterias
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the baterias.
     *
     * @param  \App\User  $user
     * @param  \App\Baterias  $baterias
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
