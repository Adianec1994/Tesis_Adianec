<?php

namespace App\Policies;

use App\User;
use App\Grupos;
use Illuminate\Auth\Access\HandlesAuthorization;

class GruposPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the grupos.
     *
     * @param  \App\User  $user
     * @param  \App\Grupos  $grupos
     * @return mixed
     */
    public function view(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','read_grupo');
    }

    /**
     * Determine whether the user can create grupos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','create_grupo');
    }

    /**
     * Determine whether the user can update the grupos.
     *
     * @param  \App\User  $user
     * @param  \App\Grupos  $grupos
     * @return mixed
     */
    public function update(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','update_grupo');
    }

    /**
     * Determine whether the user can delete the grupos.
     *
     * @param  \App\User  $user
     * @param  \App\Grupos  $grupos
     * @return mixed
     */
    public function delete(User $user)
    {
        $permissions = $user->getAllPermissions();

        return $permissions->contains('name','delete_grupo');
    }

    /**
     * Determine whether the user can restore the grupos.
     *
     * @param  \App\User  $user
     * @param  \App\Grupos  $grupos
     * @return mixed
     */
    public function restore(User $user)
    {
       return false;
    }

    /**
     * Determine whether the user can permanently delete the grupos.
     *
     * @param  \App\User  $user
     * @param  \App\Grupos  $grupos
     * @return mixed
     */
    public function forceDelete(User $user)
    {
       return false;
    }
}
