<?php

namespace App\Enums;

enum RequestCategory: string
{
    case MAINTENANCE = 'manutencao';
    case IT = 'ti';
    case FINANCIAL = 'financeiro';

    public function label(): string
    {
        return match ($this) {
            self::MAINTENANCE => 'Manutenção',
            self::IT => 'TI',
            self::FINANCIAL => 'Financeiro',
        };
    }
}
