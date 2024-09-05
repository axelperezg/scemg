<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Enums\RolesEnum;



class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function avatarUrl(): string
    {
        return "https://ui-avatars.com/api/?name={$this->name}";
    }

    public function isOperador(): bool
    {
        return $this->hasRole(RolesEnum::Operador);
    }

    public function isAdministrador(): bool
    {
        return $this->hasRole(RolesEnum::Administrador);
    }

    public function isPnd(): bool
    {
        return $this->hasRole(RolesEnum::Pnd);
    }
}
