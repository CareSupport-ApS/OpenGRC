<?php

namespace App\Models;

use App\Enums\YesNoNa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class System extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'vendor_id',
        'description',
        'logo_url',
        'system_document_link',
        'security_password_policy_compliant',
        'security_sso_connected',
    ];

    protected $casts = [
        'security_password_policy_compliant' => YesNoNa::class,
        'security_sso_connected' => YesNoNa::class,
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
