<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait PathTrait
{
    const PATH_TEXT = [
        'LEFT' => 'SL',
        'RIGHT' => 'SR'
    ];
    
    /**
     * GET MY PATH
     */
    public function getMyPath(string $parentPath, string $myUniqueId, string $parentSide)
    {
        return (string) $parentPath . $parentSide . '/' . 'P' . $myUniqueId;
        // return (string) $parentPath . '/' . 'P' . $parentUniqueId . $parentSide;
    }

    /**
     * GET LEFT SIDE USER OF A PARENT
     */
    public function getLeftSideUser(string $parent_id): User | NULL
    {
        return User::where('parent_id', $parent_id)->where('type', User::USER_TYPE['LEFT'])->first();
    }

    /**
     * GET RIGHT SIDE USER OF A PARENT
     */
    public function getRightSideUser(string $parent_id): User | NULL
    {
        return User::where('parent_id', $parent_id)->where('type', User::USER_TYPE['RIGHT'])->first();
    }
}
