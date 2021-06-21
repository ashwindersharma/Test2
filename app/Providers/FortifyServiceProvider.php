<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::authenticateUsing(function (Request $request) {
             $user = User::where('email', $request->email)->first();
            // $user2 = User::where([
            //     ['email','=',$request->email],
            //     ['deleted_at','!=',NULL]
            //     ])->first();

            $user2 = User::onlyTrashed()
                ->where('email', $request->email)
                ->first();
                //dd($user2);

            if(!empty($user2)){
                throw ValidationException::withMessages([
                    $request->email => 'User does not have the rights to login'
                ]);
                //return false;
            }
           
           
            // $status =User::where('email', $request->email)->value('+status');
            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
            else{
                // throw ValidationException::withMessages([
                //     $request->email => 'aaaaaaa'
                // ]);
                return false;
            }
        });

  // customissing the login logic 
        // Fortify::authenticateUsing(function (Request $request) {
        //     $user = User::where('email', $request->email)->first();
    
        //     if ($user &&
        //         Hash::check($request->password, $user->password)) {
        //         return false;
        //     }
        //     else{
        //         return $user;
        //     }
        // });
    }
}
