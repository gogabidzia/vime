<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request){
        if($request->user()->company){

            $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->limit(10)->get();
            return view('app.user.profilecompany', ['vacancies' => $vacancies]);
        }else{
            return view('app.user.profileuser');
        }
    }
    public function settings(Request $request){
    	if($request->user()->company){
    		return view('app.user.settingscompany');
    	}
    	else{
    		return view('app.user.settingsuser');
    	}
    }
    public function allvacancies(Request $request){
        $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->get();
        return view('app.user.allvacancies', ['vacancies'=>$vacancies]);
    }
}
