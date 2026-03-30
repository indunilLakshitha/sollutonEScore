<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Services\UserService;
use App\Traits\UniqueIdTrait;
use Illuminate\Support\Facades\Hash;

class AminSeeder extends Seeder
{
    use UniqueIdTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456789'),
            'status' => User::USER_STATUS['ER'],
        ]);

        $user->unique_id = $this->getUniqueIdForMainUser(id: $user->id);
        $user->reg_no = $this->getCustomId(id: $user->id);
        $user->type = User::MAIN;
        $user->path = "";

        (new UserService())->addLeftAccount(
            user: $user,
            status: User::USER_STATUS['ER'],
            paymentStatus: User::USER_STATUS['ER']
        );
        (new UserService())->addRightAccount(
            user: $user,
            status: User::USER_STATUS['ER'],
            paymentStatus: User::USER_STATUS['ER']
        );

        $user->save();
    }
}
