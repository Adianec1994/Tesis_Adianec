<?php

namespace App\Policies;

use App\User;
use App\EventoDiario;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoDiarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the evento diario.
     *
     * @param  \App\User  $user
     * @param  \App\EventoDiario  $eventoDiario
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_evento_diario');
    }

    /**
     * Determine whether the user can create evento diarios.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_evento_diario');
    }

    /**
     * Determine whether the user can update the evento diario.
     *
     * @param  \App\User  $user
     * @param  \App\EventoDiario  $eventoDiario
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_evento_diario');
    }

    /**
     * Determine whether the user can delete the evento diario.
     *
     * @param  \App\User  $user
     * @param  \App\EventoDiario  $eventoDiario
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_evento_diario');
    }

    /**
     * Determine whether the user can restore the evento diario.
     *
     * @param  \App\User  $user
     * @param  \App\EventoDiario  $eventoDiario
     * @return mixed
     */
    public function restore(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the evento diario.
     *
     * @param  \App\User  $user
     * @param  \App\EventoDiario  $eventoDiario
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return false;
    }
}
