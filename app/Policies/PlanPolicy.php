<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Plan $plan): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Plan $plan): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Plan $plan): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Plan $plan): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Plan $plan): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    private function hasAllowedRole(User $user): bool
    {
        if ($user->hasRole(RolesEnum::Administrador)) {
            return true;
        }

        if ($user->hasRole(RolesEnum::Operador)) {
            return false;
        }

        if ($user->hasRole(RolesEnum::Pnd)) {
            return false;
        }

        return false;
    }
}