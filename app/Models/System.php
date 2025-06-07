<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Attachment;
use App\Models\PersonalDataEntry;
use App\Models\BusinessDataEntry;

class System extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'data_storage' => 'array',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
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
}
