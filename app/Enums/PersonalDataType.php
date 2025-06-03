<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PersonalDataType: string implements HasLabel
{
    case ABSENCE_REGISTRATION = 'Absence registration';
    case ADDRESS = 'Address';
    case BANK_INFORMATION = 'Bank information';
    case BIRTHDAY = 'Birthday';
    case CUSTOMER_NUMBER = 'Customer number';
    case CV = 'CV';
    case DELIVERY_ADDRESS = 'Delivery address';
    case DRIVERS_LICENSE = 'Drivers license';
    case EMAIL = 'E-mail';
    case EDUCATIONAL_GRADES = 'Educational grades';
    case EMPLOYEE_ID = 'Employee ID';
    case INITIALS = 'Initials/login details';
    case INVOICING_INFORMATION = 'Invoicing information';
    case IP_ADDRESS = 'IP-address';
    case JOB_POSITION = 'Job position';
    case LOGGING_IT_SYSTEMS = 'Logging in IT-systems';
    case NAME = 'Name';
    case ONLINE_IDENTIFIERS = 'Online identifiers/Cookie';
    case PASSPORT_NUMBER = 'Passport number';
    case PAYMENT_INFORMATION = 'Payment information';
    case PERSONALITY_TEST = 'Personality test';
    case PHONE_NUMBER = 'Phone number';
    case PHOTOS = 'Photos';
    case SALARY = 'Salary';
    case SOCIAL_SECURITY_NUMBER = 'Social security number';
    case TAX_INFORMATION = 'Tax information';
    case TRAVEL_INFORMATION = 'Travel information';
    case VIDEO_SURVEILANCE = 'Video surveilance';
    case BIOMETRIC_DATA = 'Biometric data';
    case CRIMINAL_CONVICTIONS = 'Criminal convictions and offences';
    case GENETIC_DATA = 'Genetic data';
    case HEALTH_INFORMATION = 'Health information';
    case POLITICAL_RELIGIOUS_BELIEF = 'Political, religious or philosophical belief';
    case RACIAL_ETHNIC_ORIGIN = 'Racial and ethnic origin';
    case SEX_LIFE = 'Sex life or sexual orientation';
    case TRADE_UNION_MEMBERSHIP = 'Trade union membership';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ABSENCE_REGISTRATION => 'Absence registration',
            self::ADDRESS => 'Address',
            self::BANK_INFORMATION => 'Bank information',
            self::BIRTHDAY => 'Birthday',
            self::CUSTOMER_NUMBER => 'Customer number',
            self::CV => 'CV',
            self::DELIVERY_ADDRESS => 'Delivery address',
            self::DRIVERS_LICENSE => 'Drivers license',
            self::EMAIL => 'E-mail',
            self::EDUCATIONAL_GRADES => 'Educational grades',
            self::EMPLOYEE_ID => 'Employee ID',
            self::INITIALS => 'Initials/login details',
            self::INVOICING_INFORMATION => 'Invoicing information',
            self::IP_ADDRESS => 'IP-address',
            self::JOB_POSITION => 'Job position',
            self::LOGGING_IT_SYSTEMS => 'Logging in IT-systems',
            self::NAME => 'Name',
            self::ONLINE_IDENTIFIERS => 'Online identifiers/Cookie',
            self::PASSPORT_NUMBER => 'Passport number',
            self::PAYMENT_INFORMATION => 'Payment information',
            self::PERSONALITY_TEST => 'Personality test',
            self::PHONE_NUMBER => 'Phone number',
            self::PHOTOS => 'Photos',
            self::SALARY => 'Salary',
            self::SOCIAL_SECURITY_NUMBER => 'Social security number',
            self::TAX_INFORMATION => 'Tax information',
            self::TRAVEL_INFORMATION => 'Travel information',
            self::VIDEO_SURVEILANCE => 'Video surveilance',
            self::BIOMETRIC_DATA => 'Biometric data',
            self::CRIMINAL_CONVICTIONS => 'Criminal convictions and offences',
            self::GENETIC_DATA => 'Genetic data',
            self::HEALTH_INFORMATION => 'Health information',
            self::POLITICAL_RELIGIOUS_BELIEF => 'Political, religious or philosophical belief',
            self::RACIAL_ETHNIC_ORIGIN => 'Racial and ethnic origin',
            self::SEX_LIFE => 'Sex life or sexual orientation',
            self::TRADE_UNION_MEMBERSHIP => 'Trade union membership',
        };
    }
}
