<?php

namespace App\Policies;

use App\User;
use App\Planes;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the planes.
     *
     * @param  \App\User  $user
     * @param  \App\Planes  $planes
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_plan');
    }

    /**
     * Determine whether the user can create planes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_plan');
    }

    /**
     * Determine whether the user can update the planes.
     *
     * @param  \App\User  $user
     * @param  \App\Planes  $planes
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_plan');
    }

    /**
     * Determine whether the user can delete the planes.
     *
     * @param  \App\User  $user
     * @param  \App\Planes  $planes
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_plan');
    }

    /**
     * Determine whether the user can restore the planes.
     *
     * @param  \App\User  $user
     * @param  \App\Planes  $planes
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the planes.
     *
     * @param  \App\User  $user
     * @param  \App\Planes  $planes
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
