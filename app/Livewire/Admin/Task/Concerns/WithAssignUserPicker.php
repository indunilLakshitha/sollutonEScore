<?php

namespace App\Livewire\Admin\Task\Concerns;

use App\Models\User;

trait WithAssignUserPicker
{
    public string $assignUserSearch = '';

    /** @var array<int, int|string> */
    public array $selectedUserIds = [];

    /** @var array<int, int|string> */
    public array $selectedRoleIds = [];

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

    public function toggleAssignRole(int $roleId): void
    {
        $roleId = (int) $roleId;
        $ids = array_map('intval', $this->selectedRoleIds);

        if (in_array($roleId, $ids, true)) {
            $this->selectedRoleIds = array_values(array_filter($ids, static fn (int $id): bool => $id !== $roleId));
        } else {
            $this->selectedRoleIds = array_values(array_merge($ids, [$roleId]));
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
