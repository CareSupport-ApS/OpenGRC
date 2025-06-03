<?php

namespace App\Models;

use App\Enums\YesNoNa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\System;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier',
        'system',
        'start_date',
        'type',
        'description',
        'owner_name',
        'owner_role',
        'owner_email',
        'business_area',
        'business_process_owner',
        'system_owner',
        'primary_user',
        'primary_it',
        'it_security_policy',
        'sso_ad',
        'password_policy',
        'iso27001',
        'contract_collected',
        'contract_location',
        'contract_justification',
        'sla_collected',
        'sla_location',
        'sla_justification',
        'dpa_collected',
        'dpa_location',
        'dpa_justification',
        'privacy_policy_collected',
        'privacy_policy_location',
        'privacy_policy_justification',
    ];

    protected $casts = [
        'start_date' => 'date',
        'it_security_policy' => YesNoNa::class,
        'sso_ad' => YesNoNa::class,
        'password_policy' => YesNoNa::class,
        'iso27001' => YesNoNa::class,
        'contract_collected' => YesNoNa::class,
        'sla_collected' => YesNoNa::class,
        'dpa_collected' => YesNoNa::class,
        'privacy_policy_collected' => YesNoNa::class,
    ];

    public function systems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(System::class);
    }
}
