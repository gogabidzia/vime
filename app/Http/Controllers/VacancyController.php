<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;

class VacancyController extends Controller
{
    public function add(Request $request){
		$this->validate($request, [
			"position" => "required",
            "description" => "required",
            "date_from"=>"required|date"
        ]);
        $vacancy = new Vacancy();
        $vacancy->user_id = $request->user()->id;
        $vacancy->description = $request->get('description');
        $vacancy->position = $request->get('position');
        $vacancy->date_from = $request->get('date_from');
        $vacancy->date_to = $request->get('date_to');
        $vacancy->save();
        return redirect('/profile');
    }
    public function remove(Request $request, $id){
        $vacancy = Vacancy::findOrFail($id);
        if($request->user()->id == $vacancy->user->id){
            $vacancy->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
    public function view($id){
        $vacancy = Vacancy::findOrFail($id);
        return view('app.vacancies.view' , ['vacancy'=>$vacancy]);
    }
}
