<?php

namespace App\Enums;

enum TargetType: int
{
    case MONTHLY = 1;
    case YEARLY = 2;
    case TOTAL = 3;

    public function label(): string
    {
        return match($this) {
            self::MONTHLY => 'Monthly',
            self::YEARLY => 'Yearly',
            self::TOTAL => 'Total',
        };
    }
}
