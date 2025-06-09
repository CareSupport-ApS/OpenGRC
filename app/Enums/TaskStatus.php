<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TaskStatus: string implements HasLabel, HasColor
{
    case PENDING = 'Pending';
    case COMPLETED = 'Completed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING => 'primary',
            self::COMPLETED => 'success',
        };
    }
}
