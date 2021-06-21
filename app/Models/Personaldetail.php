<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaldetail extends Model
{
    use HasFactory;
    protected $fillable = [
         'id',
         'father',
        'mother',
        'phone',
        'email',
        'textarea',
        'profile_pic'
    ];

    protected $attributes = [
         'profile_pic'=>''

     ];
}
