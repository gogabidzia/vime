<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
class SearchController extends Controller
{
    public function search(Request $request){
    	$keyword = $request->get('keyword');
    	$q = Vacancy::query();
    	if($request->get('type')){
    		
    	}
    	if($request->get('category')){
    		
    	}
    	if($request->get('location')){
    		
    	}
    	$vacancies = Vacancy::where('position', 'like', "%{$request->get('keyword')}%")->orderBy('created_at','desc')->get();
    	return view('app.search', ['vacancies'=>$vacancies]);
    }
}
