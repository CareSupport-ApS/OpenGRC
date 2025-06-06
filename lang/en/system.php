<?php

return [
    'navigation' => [
        'label' => 'Systems',
        'group' => 'Foundations',
    ],
    'model' => [
        'label' => 'System',
        'plural_label' => 'Systems',
    ],
    'form' => [
        'title' => 'Title',
        'vendor' => 'Vendor',
        'description' => 'Description',
        'system_document_link' => 'System Documentation Link',
        'security_password_policy_compliant' => 'Password Policy Compliant',
        'security_sso_connected' => 'SSO Connected',
        'data_storage' => 'Data Storage',
    ],
    'table' => [
        'columns' => [
            'title' => 'Title',
            'vendor' => 'Vendor',
            'security_password_policy_compliant' => 'Password Policy',
            'security_sso_connected' => 'SSO',
            'data_storage' => 'Data Storage',
        ],
    ],
];
