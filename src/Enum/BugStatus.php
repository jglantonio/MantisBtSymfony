<?php

namespace App\Enum;

/**
 * Estado del ciclo de vida de una incidencia (columna `status` de `mantis_bug_table`).
 * Enumeración fija de MantisBT ($g_status_enum_string), no una tabla.
 */
enum BugStatus: int
{
    case New = 10;
    case Feedback = 20;
    case Acknowledged = 30;
    case Confirmed = 40;
    case Assigned = 50;
    case Resolved = 80;
    case Closed = 90;

    public function label(): string
    {
        return match ($this) {
            self::New => 'Nueva',
            self::Feedback => 'Feedback',
            self::Acknowledged => 'Reconocida',
            self::Confirmed => 'Confirmada',
            self::Assigned => 'Asignada',
            self::Resolved => 'Resuelta',
            self::Closed => 'Cerrada',
        };
    }
}
