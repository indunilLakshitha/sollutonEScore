<?php

namespace App\Traits;


trait UniqueIdTrait
{
    /**
     * Id + type
     * types are : M = main user L= left user R = right user
     */
    public function getUniqueIdForMainUser(string $id): string
    {
        return $id . 'M';
    }

    public function getUniqueIdForLeftUser(string $id): string
    {
        return $id . 'L';
    }

    public function getUniqueIdForRightUser(string $id): string
    {
        return $id . 'R';
    }

    public function getCustomId(string $id): string
    {
        return $id;
    }
}
