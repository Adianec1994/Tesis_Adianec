<?php

namespace App\Policies;

use App\User;
use App\Traza;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrazaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the traza.
     *
     * @param  \App\User  $user
     * @param  \App\Traza  $traza
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();
        return $permissions->contains('name','read_traza');
    }

    /**
     * Determine whether the user can create trazas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the traza.
     *
     * @param  \App\User  $user
     * @param  \App\Traza  $traza
     * @return mixed
     */
    public function update(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the traza.
     *
     * @param  \App\User  $user
     * @param  \App\Traza  $traza
     * @return mixed
     */
    public function delete(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the traza.
     *
     * @param  \App\User  $user
     * @param  \App\Traza  $traza
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the traza.
     *
     * @param  \App\User  $user
     * @param  \App\Traza  $traza
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
