<?php

namespace App\Policies;

use App\User;
use App\Operador;
use Illuminate\Auth\Access\HandlesAuthorization;

class OperadorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the operador.
     *
     * @param  \App\User  $user
     * @param  \App\Operador  $operador
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_operador');
    }

    /**
     * Determine whether the user can create operadors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_operador');
    }

    /**
     * Determine whether the user can update the operador.
     *
     * @param  \App\User  $user
     * @param  \App\Operador  $operador
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_operador');
    }

    /**
     * Determine whether the user can delete the operador.
     *
     * @param  \App\User  $user
     * @param  \App\Operador  $operador
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_operador');
    }

    /**
     * Determine whether the user can restore the operador.
     *
     * @param  \App\User  $user
     * @param  \App\Operador  $operador
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the operador.
     *
     * @param  \App\User  $user
     * @param  \App\Operador  $operador
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
