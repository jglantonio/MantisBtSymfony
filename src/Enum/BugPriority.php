<?php

namespace App\Enum;

/**
 * Prioridad de una incidencia (columna `priority` de `mantis_bug_table`).
 * Enumeración fija de MantisBT ($g_priority_enum_string), no una tabla.
 */
enum BugPriority: int
{
    case None = 10;
    case Low = 20;
    case Normal = 30;
    case High = 40;
    case Urgent = 50;
    case Immediate = 60;

    public static function getPriorityName($priority): string
    {
        return match ($priority) {
            10 => 'Ninguna',
            20 => 'Baja',
            30 => 'Normal',
            40 => 'Alta',
            50 => 'Urgente',
            60 => 'Inmediata',
            default => '',
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::None => 'Ninguna',
            self::Low => 'Baja',
            self::Normal => 'Normal',
            self::High => 'Alta',
            self::Urgent => 'Urgente',
            self::Immediate => 'Inmediata',
            default => '',
        };
    }
}
