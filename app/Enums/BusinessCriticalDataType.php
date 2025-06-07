<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BusinessCriticalDataType: string implements HasLabel
{
    case FINANCIAL = 'Financial data';
    case CUSTOMER = 'Customer data';
    case EMPLOYEE = 'Employee data';
    case INTELLECTUAL_PROPERTY = 'Intellectual property';
    case STRATEGIC = 'Strategic information';
    case SECURITY = 'Security information';
    case CONTRACTS = 'Contracts and legal';
    case SOURCE_CODE = 'Source code';
    case OPERATIONAL = 'Operational information';
    case OTHER = 'Other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FINANCIAL => 'Financial Data',
            self::CUSTOMER => 'Customer Data',
            self::EMPLOYEE => 'Employee Data',
            self::INTELLECTUAL_PROPERTY => 'Intellectual Property',
            self::STRATEGIC => 'Strategic Information',
            self::SECURITY => 'Security Information',
            self::CONTRACTS => 'Contracts and Legal',
            self::SOURCE_CODE => 'Source Code',
            self::OPERATIONAL => 'Operational Information',
            self::OTHER => 'Other',
        };
    }
}
