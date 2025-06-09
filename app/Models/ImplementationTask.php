<?php

namespace App\Models;

use App\Enums\TaskRecurrence;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class ImplementationTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'implementation_id',
        'title',
        'status',
        'completion_notes',
        'task_date',
        'attachment_id',
        'recurrence',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
        'recurrence' => TaskRecurrence::class,
        'task_date' => 'date',
    ];

    public function implementation(): BelongsTo
    {
        return $this->belongsTo(Implementation::class);
    }

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }

    protected static function booted(): void
    {
        static::updated(function (ImplementationTask $task) {
            if ($task->isDirty('status') && $task->status === TaskStatus::COMPLETED) {
                if ($task->recurrence !== TaskRecurrence::NONE) {
                    $date = $task->task_date ?? now();
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
                            'task_date' => $nextDate,
                        ])->save();
                    }
                }
            }
        });
    }
}
