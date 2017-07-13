<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
class SearchController extends Controller
{
    public function search(Request $request){
    	$q = Vacancy::query();
        if($request->get('keyword')){
            $q->where('position', 'like', "%{$request->get('keyword')}%");
        }
    	if($request->get('type')){
    		$q->where('type', $request->get('type'));
    	}
    	if($request->get('category')){
    		$q->where('category', $request->get('category'));
    	}
    	if($request->get('location')){
    		$q->where('location', $request->get('location'));
    	}
        $vacancies = $q->paginate(30);
    	return view('app.search', ['vacancies'=>$vacancies, 'req'=>$request->all()]);
    }
}
