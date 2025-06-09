<?php

namespace App\Models;

use App\Enums\TaskRecurrence;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'taskable_id',
        'taskable_type',
        'title',
        'status',
        'completion_notes',
        'due_date',
        'attachment_id',
        'recurrence',
    ];

    protected $with = ['taskable'];

    protected $casts = [
        'status' => TaskStatus::class,
        'recurrence' => TaskRecurrence::class,
        'due_date' => 'date',
    ];

    public function taskable(): MorphTo
    {
        return $this->morphTo();
    }

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }

    protected static function booted(): void
    {
        static::updated(function (Task $task) {
            if ($task->isDirty('status') && $task->status === TaskStatus::COMPLETED) {
                if ($task->recurrence !== TaskRecurrence::NONE) {
                    $date = $task->due_date ?? now();
                    $nextDate = match ($task->recurrence) {
                        TaskRecurrence::MONTHLY => Carbon::parse($date)->addMonth(),
                        TaskRecurrence::QUARTERLY => Carbon::parse($date)->addMonths(3),
                        TaskRecurrence::YEARLY => Carbon::parse($date)->addYear(),
                        default => null,
                    };
                    if ($nextDate) {
                        $task->replicate([
                            'status',
                            'completion_notes',
                            'attachment_id',
                        ])->fill([
                            'status' => TaskStatus::PENDING,
                            'completion_notes' => null,
                            'attachment_id' => null,
                            'due_date' => $nextDate,
                        ])->save();
                    }
                }
            }
        });
    }
}
