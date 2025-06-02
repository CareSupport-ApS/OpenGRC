<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum YesNoNa: string implements HasColor, HasLabel
{
    case YES = 'Yes';
    case NO = 'No';
    case NA = 'N/A';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::YES => 'Yes',
            self::NO => 'No',
            self::NA => 'N/A',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::YES => 'success',
            self::NO => 'danger',
            self::NA => 'primary',
        };
    }
}
