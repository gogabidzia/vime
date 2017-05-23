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
        'name','surname', 'phone' ,'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function company(){
        return $this->hasOne('App\Company');
    }
    public function vacancies(){
        return $this->hasMany('App\Vacancy');
    }
    public function videos(){
        return $this->hasMany('App\Video');
    }
    public function bids(){
        return $this->hasMany('App\Bid');
    }
    public function notifications(){
        return $this->hasMany('App\Notification');
    }
    public function savedvacancies(){
        return $this->hasMany('App\SavedVacancy');
    }
}
