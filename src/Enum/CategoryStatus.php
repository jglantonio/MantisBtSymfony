<?php

namespace App\Enum;

enum CategoryStatus: int
{
    case Active = 0;
    case Deprecated = 1;

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getLabel(): string
    {
        return match ($this->status) {
            self::Active => 'Activa',
            self::Deprecated => 'Deprecada',
        };
    }
}
