<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use App\User;
class AdminController extends Controller
{
    public function index(){
    	$vacancies = Vacancy::orderBy('created_at','desc')->where('type','vacancy')->limit(5)->get();
    	$events = Vacancy::orderBy('created_at','desc')->where('type','facecontrol')->limit(5)->get();
    	$companies = User::orderBy('created_at', 'desc')->where('type', 'company')->limit(5)->get();
    	$users = User::orderBy('created_at', 'desc')->where('type', 'user')->limit(5)->get();
    	return view('app.admin.index',[
    		'vacancies'=>$vacancies,
    		'events'=>$events,
    		'companies'=>$companies,
    		'users'=>$users
    	]);
    }
    public function removeuser($id){

    }
    public function removevacancy($id){
    	
    }
}
