<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    public const STATUS_UNASSIGNED = 'Unassigned';
    public const STATUS_ASSIGNED = 'Assigned';
    public const STATUS_SUBMITTED = 'Submitted';
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_REJECTED = 'Rejected';

    protected $fillable = [
        'task_category_id',
        'assigned_user_id',
        'name',
        'max_score',
        'deadline_at',
        'status',
        'submission_note',
        'submitted_at',
        'score',
        'approved_at',
        'rejected_at',
        'pre_deadline_reminder_sent_at',
        'deadline_imminent_alert_sent_at',
    ];

    protected $casts = [
        'deadline_at' => 'datetime',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'pre_deadline_reminder_sent_at' => 'datetime',
        'deadline_imminent_alert_sent_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TaskCategory::class, 'task_category_id');
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    /**
     * Same task definition: category, title, max score, and deadline (both null matches both null).
     *
     * @param  Builder<Task>  $query
     */
    public function scopeForSameDefinitionAs(Builder $query, Task $template): void
    {
        $query->where('task_category_id', $template->task_category_id)
            ->where('name', $template->name)
            ->where('max_score', $template->max_score);

        if ($template->deadline_at === null) {
            $query->whereNull('deadline_at');
        } else {
            $dt = $template->deadline_at instanceof Carbon
                ? $template->deadline_at
                : Carbon::parse((string) $template->deadline_at);
            $query->where('deadline_at', $dt->format('Y-m-d H:i:s'));
        }
    }

    public function assignmentExistsForUserId(int $userId): bool
    {
        return static::query()
            ->forSameDefinitionAs($this)
            ->where('assigned_user_id', $userId)
            ->exists();
    }

    /**
     * @return array<int, int>
     */
    public static function assignedUserIdsForDefinition(Task $template): array
    {
        return static::query()
            ->forSameDefinitionAs($template)
            ->whereNotNull('assigned_user_id')
            ->pluck('assigned_user_id')
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    public function getIsExpiredAttribute(): bool
    {
        if (!$this->deadline_at || $this->status === self::STATUS_UNASSIGNED) {
            return false;
        }

        return Carbon::now()->greaterThan($this->deadline_at)
            && !in_array($this->status, [self::STATUS_APPROVED], true);
    }
}

