<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

<<<<<<< HEAD:hydromel-laravel/app/User.php
class User extends Authenticatable
{
=======
class User extends Authenticatable {

>>>>>>> Back:hydromel-laravel/app/Models/User.php
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
