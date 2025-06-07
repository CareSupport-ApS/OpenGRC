<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BusinessCriticalDataType: string implements HasLabel
{
    case CUSTOMER_DATA = 'Customer data';
    case EMPLOYEE_DATA = 'Employee data';
    case FINANCIAL_DATA = 'Financial data';
    case INTELLECTUAL_PROPERTY = 'Intellectual property';
    case BUSINESS_CONTRACTS = 'Business contracts and agreements';
    case SUPPLIER_VENDOR_DATA = 'Supplier and vendor data';
    case PRODUCTION_MANUFACTURING_DATA = 'Production and manufacturing data';
    case OPERATIONAL_PERFORMANCE_DATA = 'Operational performance data';
    case INVENTORY_LOGISTICS_DATA = 'Inventory and logistics data';
    case STRATEGIC_BUSINESS_PLANS = 'Strategic business plans';
    case BOARD_MANAGEMENT_DOCUMENTATION = 'Board and management documentation';
    case TAX_REGULATORY_FILINGS = 'Tax and regulatory filings';
    case COMPLIANCE_AUDIT_RECORDS = 'Compliance and audit records';
    case RISK_INCIDENT_LOGS = 'Risk and incident logs';
    case IT_INFRASTRUCTURE_CONFIGURATIONS = 'IT infrastructure configurations';
    case SYSTEM_ACCESS_LOGS = 'System access logs and audit trails';
    case INTERNAL_CONFIDENTIAL_COMMUNICATION = 'Internal confidential communication';
    case CRM_SALES_PIPELINE_DATA = 'CRM and sales pipeline data';
    case OTHER = 'Other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CUSTOMER_DATA => 'Customer Data',
            self::EMPLOYEE_DATA => 'Employee Data',
            self::FINANCIAL_DATA => 'Financial Data',
            self::INTELLECTUAL_PROPERTY => 'Intellectual Property',
            self::BUSINESS_CONTRACTS => 'Business Contracts and Agreements',
            self::SUPPLIER_VENDOR_DATA => 'Supplier and Vendor Data',
            self::PRODUCTION_MANUFACTURING_DATA => 'Production and Manufacturing Data',
            self::OPERATIONAL_PERFORMANCE_DATA => 'Operational Performance Data',
            self::INVENTORY_LOGISTICS_DATA => 'Inventory and Logistics Data',
            self::STRATEGIC_BUSINESS_PLANS => 'Strategic Business Plans',
            self::BOARD_MANAGEMENT_DOCUMENTATION => 'Board and Management Documentation',
            self::TAX_REGULATORY_FILINGS => 'Tax and Regulatory Filings',
            self::COMPLIANCE_AUDIT_RECORDS => 'Compliance and Audit Records',
            self::RISK_INCIDENT_LOGS => 'Risk and Incident Logs',
            self::IT_INFRASTRUCTURE_CONFIGURATIONS => 'IT Infrastructure Configurations',
            self::SYSTEM_ACCESS_LOGS => 'System Access Logs and Audit Trails',
            self::INTERNAL_CONFIDENTIAL_COMMUNICATION => 'Internal Confidential Communication',
            self::CRM_SALES_PIPELINE_DATA => 'CRM and Sales Pipeline Data',
            self::OTHER => 'Other',
        };
    }
}
