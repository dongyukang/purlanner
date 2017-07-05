<?php

namespace App;

use App\Term;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use DongyuKang\PurdueCourse\Facades\Purdue;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
        'password', 'remember_token'
    ];

    public function __construct()
    {
      
    }

    public function terms()
    {
      return $this->belongsToMany('App\Term', 'term_user', 'user_id');
    }

    protected function isCurrentTermSet()
    {
    }

    /**
     * If courses for current term is empty.
     *
     * @return Boolean
     */
    public function isCurrentCourseEmpty()
    {
      return true;
    }
}
