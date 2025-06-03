<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DataStorageType: string implements HasColor, HasLabel
{
    case EMAIL = 'Email';
    case FILEDRIVE = 'Filedrive';
    case PHYSICAL_ARCHIVE = 'Physical Archive';
    case SERVICE_PROVIDER = 'Service Provider';
    case CLOUD = 'Cloud';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::EMAIL => 'E-mail',
            self::FILEDRIVE => 'Filedrive',
            self::PHYSICAL_ARCHIVE => 'Physical Archive',
            self::SERVICE_PROVIDER => 'Service Provider',
            self::CLOUD => 'Cloud',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::EMAIL => 'gray',
            self::FILEDRIVE => 'blue',
            self::PHYSICAL_ARCHIVE => 'yellow',
            self::SERVICE_PROVIDER => 'purple',
            self::CLOUD => 'cyan',
        };
    }
}
