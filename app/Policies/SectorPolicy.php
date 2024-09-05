<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $this->hasAllowedRole($user);
    }

    public function create(User $user): bool
    {
        return $this->hasAllowedRole($user);
    }

    public function update(User $user, Sector $sector): bool
    {
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
