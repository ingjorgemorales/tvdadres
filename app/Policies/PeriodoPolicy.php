<?php

namespace App\Policies;

use App\Models\Periodo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PeriodoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any periodo');
        //return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('view periodo');
        //return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create periodo');
        //return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('update periodo');
        //return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Periodo $periodo): bool
    {
        return $user->hasPermissionTo('delete periodo');
        //return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Periodo $periodo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Periodo $periodo): bool
    {
        return false;
    }
}
