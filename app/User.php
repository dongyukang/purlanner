<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'first_access'
    ];

    /**
     * If current user is accessed to the application for the first time,
     * return 'true'.
     *
     * @return Boolean
     */
    public function firstAccess()
    {
      return $this->first_access;
    }
}
