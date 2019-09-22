<?php

namespace App\Policies;

use App\User;
use App\Brigada;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrigadaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the brigada.
     *
     * @param  \App\User  $user
     * @param  \App\Brigada  $brigada
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_brigada');
    }

    /**
     * Determine whether the user can create brigada.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_brigada');
    }

    /**
     * Determine whether the user can update the brigada.
     *
     * @param  \App\User  $user
     * @param  \App\Brigada  $brigada
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_brigada');
    }

    /**
     * Determine whether the user can delete the brigada.
     *
     * @param  \App\User  $user
     * @param  \App\Brigada  $brigada
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_brigada');
    }

    /**
     * Determine whether the user can restore the brigada.
     *
     * @param  \App\User  $user
     * @param  \App\Brigada  $brigada
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the brigada.
     *
     * @param  \App\User  $user
     * @param  \App\Brigada  $brigada
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
