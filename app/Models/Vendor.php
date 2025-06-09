<?php

namespace App\Models;

use App\Enums\VendorType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Attachment;
use App\Models\PersonalDataEntry;
use App\Models\BusinessDataEntry;
use App\Models\System;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'id' => 'integer',
        'engagement_date' => 'date',
        'vendor_type' => VendorType::class,
        'is_data_processor' => 'boolean',
        'has_dpa' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'description',
        'engagement_date',
        'internal_owner_name',
        'internal_owner_email',
        'internal_owner_role',
        'business_area',
        'vendor_type',
        'is_data_processor',
        'has_dpa',
        'key_contact_name',
        'key_contact_email',
        'key_contact_role',
    ];

    public function systems(): HasMany
    {
        return $this->hasMany(System::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function personalDataEntries(): MorphMany
    {
        return $this->morphMany(PersonalDataEntry::class, 'processable');
    }

    public function businessDataEntries(): MorphMany
    {
        return $this->morphMany(BusinessDataEntry::class, 'processable');
    }

    public function systemPersonalDataEntries(): HasManyThrough
    {
        return $this->hasManyThrough(
            PersonalDataEntry::class,
            System::class,
            'vendor_id',
            'processable_id'
        )->where('personal_data_entries.processable_type', System::class);
    }

    public function systemBusinessDataEntries(): HasManyThrough
    {
        return $this->hasManyThrough(
            BusinessDataEntry::class,
            System::class,
            'vendor_id',
            'processable_id'
        )->where('business_data_entries.processable_type', System::class);
    }
}
