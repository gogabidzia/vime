<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
	protected $table = 'vacancies';
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
