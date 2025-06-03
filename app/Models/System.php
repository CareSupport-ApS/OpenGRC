<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Attachment;

class System extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'id' => 'integer',
        'vendor_id' => 'integer',
        'security_password_policy_compliant' => 'boolean',
        'security_sso_connected' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'vendor_id',
        'description',
        'logo_url',
        'system_document_link',
        'security_password_policy_compliant',
        'security_sso_connected',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
