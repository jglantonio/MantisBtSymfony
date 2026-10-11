<?php

namespace App\Enum;

/**
 * Estado del estado del proyecto
 */
enum ProjectStatus: int
{
    public static function getStatusName($status): string
    {
        $status = (int)$status;
        return match ($status) {
            10 => 'Desarrollo',
            30 => 'Publicado',
            50 => 'Estable',
            60 => 'Obsoleto',
            default => '',
        };
    }
}
