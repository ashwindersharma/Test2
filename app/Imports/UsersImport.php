<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersImport implements ToModel, WithValidation,WithHeadingRow, SkipsOnFailure
{
    /**
     *
     *
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use  Importable,SkipsFailures;
    public function model(array $row)
    {

        return new User([
            'name'     => $row['name'],
            'lastname' =>$row['lastname'],
            'email'    => $row['email'],
            'phone'  => $row['phone'],
            'password' => Hash::make($row['password']),
            'longitude' =>$row['longitude'],
            'latitude' =>$row['latitude']
        ]);
    }



    public function rules(): array
{
    return [

        '*.name' =>[
            'required','string', 'max:100'
        ],
        '*.lastname' =>[
            'required','string', 'max:100'
        ],
        '*.email' =>[
            'required', 'email','unique:App\Models\User,email'
        ],
        '*.password' =>[
            'required','min:6'
        ],
        '*.phone' =>[
            'required','numeric','digits:10','unique:App\Models\User,phone'
        ],
        '*.latitude' =>[
            'required','regex:/(^[0-9]{2}\.\d{1,3}$)/'
        ],
        '*.longitude' =>[
            'required','regex:/(^[0-9]{2}\.\d{1,3}$)/'
        ],

    ];
}

public function customValidationMessages()
{
    return [
        'email.required' => 'Email is missing ',
        'phone.unique' =>'phone number is taken ',
        'latitude.regex'=>'does not matches the pattern'
    ];
}



}
