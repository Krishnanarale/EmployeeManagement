<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName', 
        'gender',
        'dateOfBirth',
        'email',
        'phone',
        'languages',
        'photo',
    ];
}
