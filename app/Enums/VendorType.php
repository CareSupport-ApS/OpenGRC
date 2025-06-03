<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum VendorType: string implements HasColor, HasLabel
{
    case CONSULTANT = 'Consultant';
    case SERVICE_PROVIDER = 'Service Provider';
    case IT_SYSTEM_PROVIDER = 'IT System Provider';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CONSULTANT => 'Consultant',
            self::SERVICE_PROVIDER => 'Service Provider',
            self::IT_SYSTEM_PROVIDER => 'IT System Provider',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CONSULTANT => 'primary',
            self::SERVICE_PROVIDER => 'primary',
            self::IT_SYSTEM_PROVIDER => 'primary',
        };
    }
}
