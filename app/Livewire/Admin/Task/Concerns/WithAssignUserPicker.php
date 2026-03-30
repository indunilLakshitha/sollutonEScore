<?php

namespace App\Livewire\Admin\Task\Concerns;

use App\Models\User;

trait WithAssignUserPicker
{
    public string $assignUserSearch = '';

    /** @var array<int, int|string> */
    public array $selectedUserIds = [];

    public function toggleAssignUser(int $userId): void
    {
        $userId = (int) $userId;
        $ids = array_map('intval', $this->selectedUserIds);

        if (in_array($userId, $ids, true)) {
            $this->selectedUserIds = array_values(array_filter($ids, static fn (int $id): bool => $id !== $userId));
        } else {
            $this->selectedUserIds = array_values(array_merge($ids, [$userId]));
        }
    }

    public function getAssignModalUserResultsProperty()
    {
        $s = trim($this->assignUserSearch);
        if ($s === '') {
            return collect();
        }

        return User::query()
            ->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('reg_no', 'like', "%{$s}%");
            })
            ->orderBy('name')
            ->limit(25)
            ->get(['id', 'name', 'reg_no']);
    }
}
