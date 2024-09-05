<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InstitutionPolicy
{
    use HandlesAuthorization;
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
    public function view(User $user, Institution $institution): bool
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
    public function update(User $user, Institution $institution): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Institution $institution): bool
    {
        //
        return $this->hasAllowedRole($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Institution $institution): bool
    {
        //
        return $this->hasAllowedRole($user);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Institution $institution): bool
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