<?php

namespace App\Enums\Customers;

enum CustomerTypeEnum: int
{
    case INDIVIDUAL = 0;
    case CORPORATIVE = 1;

    function toString(): string
    {
        return match ($this) {
            self::INDIVIDUAL => 'fərdi',
            self::CORPORATIVE => 'korporativ',
        };
    }
}