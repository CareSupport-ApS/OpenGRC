<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DataSubjectCategory: string implements HasLabel
{
    case CUSTOMERS = 'Customers';
    case EMPLOYEES = 'Employees';
    case FORMER_CUSTOMERS = 'Former customers';
    case FORMER_EMPLOYEES = 'Former employees';
    case JOB_APPLICANTS = 'Job applicants';
    case POTENTIAL_CUSTOMERS = 'Potential customers';
    case VENDORS = 'Vendors';
    case WEBSITE_VISITORS = 'Website visitors';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CUSTOMERS => 'Customers',
            self::EMPLOYEES => 'Employees',
            self::FORMER_CUSTOMERS => 'Former Customers',
            self::FORMER_EMPLOYEES => 'Former Employees',
            self::JOB_APPLICANTS => 'Job Applicants',
            self::POTENTIAL_CUSTOMERS => 'Potential Customers',
            self::VENDORS => 'Vendors',
            self::WEBSITE_VISITORS => 'Website Visitors',
        };
    }
}
