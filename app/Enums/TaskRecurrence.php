<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TaskRecurrence: string implements HasLabel
{
    case NONE = 'None';
    case MONTHLY = 'Monthly';
    case QUARTERLY = 'Quarterly';
    case YEARLY = 'Yearly';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NONE => 'None',
            self::MONTHLY => 'Monthly',
            self::QUARTERLY => 'Quarterly',
            self::YEARLY => 'Yearly',
        };
    }
}
