<?php

namespace App\Models;

use App\Enums\Applicability;
use App\Enums\ControlStatus;
use App\Enums\ControlCategory;
use App\Enums\ControlEnforcementCategory;
use App\Enums\ControlType;
use App\Enums\Effectiveness;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Program;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Control
 *
 * @property int $id
 * @property ControlStatus $status
 * @property Effectiveness $effectiveness
 * @property ControlType $type
 * @property ControlCategory $category
 * @property ControlEnforcementCategory $enforcement
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Standard $standard
 * @property-read Collection|Implementation[] $implementations
 * @property-read int|null $implementations_count
 * @property-read Collection|AuditItem[] $auditItems
 * @property-read int|null $auditItems_count
 * @property-read Collection|AuditItem[] $completedAuditItems
 * @property-read int|null $completedAuditItems_count
 *
 * @method static Builder|Control newModelQuery()
 * @method static Builder|Control newQuery()
 * @method static \Illuminate\Database\Query\Builder|Control onlyTrashed()
 * @method static Builder|Control query()
 * @method static Builder|Control whereCreatedAt($value)
 * @method static Builder|Control whereDeletedAt($value)
 * @method static Builder|Control whereId($value)
 * @method static Builder|Control whereStatus($value)
 * @method static Builder|Control whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Control withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Control withoutTrashed()
 *
 * @mixin Eloquent
 */
class Control extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Indicates if the model should be indexed as you type.
     */
    public bool $asYouType = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'status' => ControlStatus::class,
        'effectiveness' => Effectiveness::class,
        'type' => ControlType::class,
        'category' => ControlCategory::class,
        'enforcement' => ControlEnforcementCategory::class,
        'parent_control_id' => 'integer',
    ];

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'controls_index';
    }

    /**
     * Get the array representation of the model for search.
     */
    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    /**
     * Get the standard that owns the control.
     */
    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    /**
     * Get the parent control if this control is a sub-control.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_control_id');
    }

    /**
     * Get the sub-controls for this control.
     */
    public function subControls(): HasMany
    {
        return $this->hasMany(self::class, 'parent_control_id');
    }

    /**
     * The implementations that belong to the control.
     */
    public function implementations(): BelongsToMany
    {
        return $this->belongsToMany(Implementation::class)
            ->withTimestamps();
    }

    /**
     * Get the audit items for the control.
     */
    public function auditItems(): MorphMany
    {
        return $this->morphMany(AuditItem::class, 'auditable');
    }

    /**
     * Get the effectiveness of the control.
     */
    public function getEffectiveness(): Effectiveness
    {
        $latestAuditItem = $this->latestCompletedAuditItem();

        return $latestAuditItem ? $latestAuditItem->effectiveness : Effectiveness::UNKNOWN;
    }

    /**
     * Get the completed audit items for the control.
     */
    public function completedAuditItems(): MorphMany
    {
        return $this->audits()->where('status', '=', 'Completed');
    }

    /**
     * Get the latest completed audit item for the control.
     */
    public function latestCompletedAuditItem(): ?AuditItem
    {
        $latestCompletedAuditItem = $this->completedAuditItems()->latest()->first();

        return $latestCompletedAuditItem instanceof AuditItem ? $latestCompletedAuditItem : null;
    }

    /**
     * Get all the audit items for the control.
     */
    public function audits(): MorphMany
    {
        return $this->morphMany(AuditItem::class, 'auditable');
    }

    /**
     * Get the date of the last effectiveness update.
     */
    public function getEffectivenessDate(): string
    {
        $latestAuditItem = $this->latestCompletedAuditItem();

        return $latestAuditItem ? $latestAuditItem->updated_at->isoFormat('MMM D, YYYY') : 'Never';
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class);
    }

    protected static function booted()
    {
        static::saved(function (Control $control) {
            if ($control->parent) {
                $parent = $control->parent;

                if ($control->status !== ControlStatus::COMPLETED) {
                    if ($parent->status !== ControlStatus::IN_PROGRESS) {
                        $parent->status = ControlStatus::IN_PROGRESS;
                        $parent->save();
                    }
                } else {
                    if ($parent->subControls()->where('status', '!=', ControlStatus::COMPLETED)->count() === 0) {
                        $parent->status = ControlStatus::COMPLETED;
                        $parent->save();
                    } else {
                        $parent->status = ControlStatus::IN_PROGRESS;
                        $parent->save();
                    }
                }
            }
        });
    }
}
