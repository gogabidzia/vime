<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function vacancy(){
    	return $this->belongsTo('App\Vacancy');
    }
    public function video(){
    	return $this->belongsTo('App\Video');
    }
}
