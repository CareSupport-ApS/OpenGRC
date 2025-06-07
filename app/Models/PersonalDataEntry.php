<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PersonalDataEntry extends Model
{
    protected $fillable = [
        'subject_category',
        'process_name',
        'purpose',
        'data_types',
    ];

    protected $casts = [
        'data_types' => 'array',
    ];

    public function processable(): MorphTo
    {
        return $this->morphTo();
    }
}
