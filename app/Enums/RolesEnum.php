<?php

namespace App\Enums;

enum RolesEnum: string
{
    case Administrador = 'Administrador';
    case Operador = 'Operador';
    case Pnd = 'Pnd';
    

    public function label(): string
    {
        return match ($this) {
            self::Administrador => 'Administrador',
            self::Operador => 'Operador',
            self::Pnd => 'Pnd',
        };
    }
}