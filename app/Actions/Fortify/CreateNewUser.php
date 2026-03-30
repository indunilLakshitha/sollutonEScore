<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\UserService;
use App\Traits\UniqueIdTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, UniqueIdTrait;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->unique_id = $this->getUniqueIdForMainUser(id: $user->id);
        $user->reg_no = $this->getCustomId(id: $user->id);
        $user->type = User::MAIN;
        $user->path = "";

        (new UserService())->addLeftAccount(user: $user);
        (new UserService())->addRightAccount(user: $user);

        $user->save();

        return $user;
    }
}
