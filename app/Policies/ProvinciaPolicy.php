<?php

namespace App\Policies;

use App\User;
use App\Provincia;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvinciaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the provincia.
     *
     * @param  \App\User  $user
     * @param  \App\Provincia  $provincia
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_provincia');
    }

    /**
     * Determine whether the user can create provincias.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_provincia');
    }

    /**
     * Determine whether the user can update the provincia.
     *
     * @param  \App\User  $user
     * @param  \App\Provincia  $provincia
     * @return mixed
     */
    public function update(User $user, Provincia $provincia)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_provincia');
    }

    /**
     * Determine whether the user can delete the provincia.
     *
     * @param  \App\User  $user
     * @param  \App\Provincia  $provincia
     * @return mixed
     */
    public function delete(User $user, Provincia $provincia)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_provincia');
    }

    /**
     * Determine whether the user can restore the provincia.
     *
     * @param  \App\User  $user
     * @param  \App\Provincia  $provincia
     * @return mixed
     */
    public function restore(User $user, Provincia $provincia)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the provincia.
     *
     * @param  \App\User  $user
     * @param  \App\Provincia  $provincia
     * @return mixed
     */
    public function forceDelete(User $user, Provincia $provincia)
    {
        return false;
    }
}
