<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
class FaceController extends Controller
{
    public function index(){
		$events = Vacancy::orderBy('created_at','desc')->where('type','facecontrol')->paginate(15);
    	return view('facecontrol.index', ['events'=> $events]);
    }
}
