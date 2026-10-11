<?php

namespace App\Enum;

/**
 * Estado del estado del proyecto
 */
enum ProjectStateName: int
{
    public static function getName($status): string
    {
        $status = (int)$status;
        return match ($status) {
            10 => 'Publico',
            50 => 'Privado',
            default => '',
        };
    }
}
