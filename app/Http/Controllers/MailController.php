<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
    public function index($id){
    	Mail::raw($id, function ($message){
    		$message->to('gogabidzia@gmail.com', $name = null);
		});
    }
}
