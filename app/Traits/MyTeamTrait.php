<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait MyTeamTrait
{
    public function getMyTeam(string $userId)
    {
        $user = User::find($userId);
        $myCode = 'P' . $user->unique_id;

        return  User::where('approved_by_admin', true)
            ->where('type', User::USER_TYPE['MAIN'])
            ->where('path', 'like', '%' .  $myCode . '%')
            ->where('id', '!=', $user->id)
            ->select(
                'id',
                'reg_no',
                'er_status',
                'name',
                'dummy_a2_id',
                'dummy_a1_id',
                'parent_id',
                'left_points',
                'right_points'
            )
            ->get();
    }

    public function getMyFullTeam(string $userId)
    {
        $user = User::find($userId);
        $myCode = 'P' . $user->unique_id;

        $users =   User::where('type', User::USER_TYPE['MAIN'])
            ->where(function ($q) use ($myCode, $user) {
                $q->where('path', 'like', '%' .  $myCode . '%')
                    ->where('referrer_id', '!=', $user->id);
            })
            ->orWhere('referrer_id', $user->id)

            ->where('id', '!=', $user->id)
            ->select(
                'id',
                'reg_no',
                'er_status',
                'name',
                'dummy_a2_id',
                'dummy_a1_id',
                'parent_id',
                'left_points',
                'right_points'
            )
            ->get();

        return $users->unique();
    }

    /**
     * RETURN ALL MAIN USERS
     */
    public function getAvailableMainUsers(Collection $users)
    {
        $data = [];
        foreach ($users as $user) {
            if (
                $user->type ==  User::USER_TYPE['MAIN']
                // && $user->er_status !=  User::USER_STATUS['ER']
                // && $user->er_status !=  User::USER_STATUS['NONE']
            ) {
                array_push($data, $user);
            }
        }

        return collect($data);
    }

    /**
     * RETURN DUMMY USERS ER ACTIVE
     */
    public function getAvailableDummyUsers(Collection $users)
    {
        $data = [];
        foreach ($users as $user) {
            if (
                $user->type !=  User::USER_TYPE['MAIN']
                && $user->er_status ==  User::USER_STATUS['ER']
            ) {
                array_push($data, $user);
            }
        }
        // dd($data);
        return collect($data);
    }
}
