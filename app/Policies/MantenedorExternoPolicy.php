<?php

namespace App\Policies;

use App\User;
use App\MantenedorExterno;
use Illuminate\Auth\Access\HandlesAuthorization;

class MantenedorExternoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mantenedor externo.
     *
     * @param  \App\User  $user
     * @param  \App\MantenedorExterno  $mantenedorExterno
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_mantenedor_externo');
    }

    /**
     * Determine whether the user can create mantenedor externos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_mantenedor_externo');
    }

    /**
     * Determine whether the user can update the mantenedor externo.
     *
     * @param  \App\User  $user
     * @param  \App\MantenedorExterno  $mantenedorExterno
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_mantenedor_externo');
    }

    /**
     * Determine whether the user can delete the mantenedor externo.
     *
     * @param  \App\User  $user
     * @param  \App\MantenedorExterno  $mantenedorExterno
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_mantenedor_externo');
    }

    /**
     * Determine whether the user can restore the mantenedor externo.
     *
     * @param  \App\User  $user
     * @param  \App\MantenedorExterno  $mantenedorExterno
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the mantenedor externo.
     *
     * @param  \App\User  $user
     * @param  \App\MantenedorExterno  $mantenedorExterno
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
