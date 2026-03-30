<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('reg_no', $request->reg_no)->first();
            if(!$user){
                       throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => ['Sorry, Invalid User'],
                ]);
            }

            // if ($user->active_status == User::BLOCKED) {
            //     throw \Illuminate\Validation\ValidationException::withMessages([
            //         'email' => ['Sorry, Your Account has Blocked. Please Contact Admin'],
            //     ]);
            // }
            if (

                Hash::check($request->password, $user->password)
            ) {

                return $user;
            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
