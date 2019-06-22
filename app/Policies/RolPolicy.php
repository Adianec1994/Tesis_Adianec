<?php

namespace App\Policies;

use App\User;
use App\Rol;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the rol.
     *
     * @param  \App\User  $user
     * @param  \App\Rol  $rol
     * @return mixed
     */
    public function view(User $user, Rol $rol)
    {
        //
    }

    /**
     * Determine whether the user can create rols.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the rol.
     *
     * @param  \App\User  $user
     * @param  \App\Rol  $rol
     * @return mixed
     */
    public function update(User $user, Rol $rol)
    {
        //
    }

    /**
     * Determine whether the user can delete the rol.
     *
     * @param  \App\User  $user
     * @param  \App\Rol  $rol
     * @return mixed
     */
    public function delete(User $user, Rol $rol)
    {
        //
    }

    /**
     * Determine whether the user can restore the rol.
     *
     * @param  \App\User  $user
     * @param  \App\Rol  $rol
     * @return mixed
     */
    public function restore(User $user, Rol $rol)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the rol.
     *
     * @param  \App\User  $user
     * @param  \App\Rol  $rol
     * @return mixed
     */
    public function forceDelete(User $user, Rol $rol)
    {
        //
    }
}
