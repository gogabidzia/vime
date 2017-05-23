<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedVacancy extends Model
{
    protected $table = "savedvacancies";

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function vacancy(){
    	return $this->belongsTo('App\Vacancy');
    }
}
