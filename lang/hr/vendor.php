<?php

return [
    'navigation' => [
        'label' => 'Vendors',
        'group' => 'Foundations',
    ],
    'model' => [
        'label' => 'Vendor',
        'plural_label' => 'Vendors',
    ],
    'breadcrumb' => [
        'title' => 'Vendors',
    ],
    'form' => [
        'name' => 'Name',
        'description' => 'Description',
        'engagement_date' => 'Engagement Date',
        'internal_owner_name' => 'Internal Owner Name',
        'internal_owner_email' => 'Internal Owner Email',
        'internal_owner_role' => 'Internal Owner Role',
        'business_area' => 'Business Area',
        'vendor_type' => 'Vendor Type',
        'is_data_processor' => 'Data Processor',
        'has_dpa' => 'Data Processing Agreement',
        'key_contact_name' => 'Key Contact Name',
        'key_contact_email' => 'Key Contact Email',
        'key_contact_role' => 'Key Contact Role',
    ],
    'table' => [
        'description' => 'Manage external vendors and service providers that support your organization.',
        'columns' => [
            'name' => 'Name',
            'business_area' => 'Business Area',
            'vendor_type' => 'Vendor Type',
            'is_data_processor' => 'Data Processor',
            'has_dpa' => 'Has DPA',
        ],
    ],
];
