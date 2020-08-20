<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public const ROLES = [
        'manager'   => 0,
        'employer'  => 1
     ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * determins if the user role is Manager
    * @return bool
    */
    public function isManager()
    {
        return $this->role == self::ROLES['manager'];
    }
    
    /**
    * determins if the user role is Employer
    * @return bool
    */
    public function isEmployer()
    {
        return $this->role == self::ROLES['employer'];
    }
}
