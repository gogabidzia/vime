<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = "companies";
	protected $fillable = ['user_id'];
	
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
