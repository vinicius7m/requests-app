<?php

namespace App\Enums;

enum RequestStatus: string
{
    case OPEN = 'open';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Aberta',
            self::APPROVED => 'Aprovada',
            self::REJECTED => 'Rejeitada',
            self::CANCELLED => 'Cancelada',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::OPEN => 'text-white',
            self::APPROVED => 'text-green-600',
            self::REJECTED => 'text-red-600',
            self::CANCELLED => 'text-gray-500',
        };
    }

}
