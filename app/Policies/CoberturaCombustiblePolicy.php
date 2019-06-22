<?php

namespace App\Policies;

use App\User;
use App\CoberturaCombustible;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoberturaCombustiblePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cobertura combustible.
     *
     * @param  \App\User  $user
     * @param  \App\CoberturaCombustible  $coberturaCombustible
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_cobertura_combustible');
    }

    /**
     * Determine whether the user can create cobertura combustibles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_cobertura_combustible');
    }

    /**
     * Determine whether the user can update the cobertura combustible.
     *
     * @param  \App\User  $user
     * @param  \App\CoberturaCombustible  $coberturaCombustible
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_cobertura_combustible');
    }

    /**
     * Determine whether the user can delete the cobertura combustible.
     *
     * @param  \App\User  $user
     * @param  \App\CoberturaCombustible  $coberturaCombustible
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_cobertura_combustible');
    }

    /**
     * Determine whether the user can restore the cobertura combustible.
     *
     * @param  \App\User  $user
     * @param  \App\CoberturaCombustible  $coberturaCombustible
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the cobertura combustible.
     *
     * @param  \App\User  $user
     * @param  \App\CoberturaCombustible  $coberturaCombustible
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
