<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ControlStatus: string implements HasColor, HasLabel
{
    case NOT_STARTED = 'Not Started';
    case IN_PROGRESS = 'In Progress';
    case COMPLETED = 'Completed';
    case UNKNOWN = 'Unknown';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NOT_STARTED => __('enums.control_status.not_started'),
            self::IN_PROGRESS => __('enums.control_status.in_progress'),
            self::COMPLETED => __('enums.control_status.completed'),
            self::UNKNOWN => __('enums.control_status.unknown'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NOT_STARTED => 'danger',
            self::IN_PROGRESS => 'warning',
            self::COMPLETED => 'success',
            self::UNKNOWN => 'gray',
        };
    }
}
