<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
 use Illuminate\Support\Facades\Storage;
 use Spatie\Permission\Traits\HasRoles;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
   // use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {


        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'photo'=>'sometimes|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        ])->validate();


            if (array_key_exists('photo',$input)){

                $path = $input['photo']->store('photo','public');

            }
            else $path="";

     return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
             'profile_photo_path'=>$path

        ]);


    }
}
