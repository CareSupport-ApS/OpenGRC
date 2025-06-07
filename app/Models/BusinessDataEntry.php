<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BusinessDataEntry extends Model
{
    protected $fillable = [
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
