<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use Validator;
use App\Video;
use App\Bid;
use App\Notification;
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

    public function bid(Request $request){
        $video = Video::findOrFail($request->get('video_id'));
        if($video && $request->user()->id !== $video->user->id ){
            return redirect()->back();
        }
        $bidded = false;
        $bids = Vacancy::findOrFail($request->get('id'))->bids;
        foreach($bids as $bid){
            if($bid->user->id == $request->user()->id){
                $bidded = true;
            }
        }
        if($bidded){
            return redirect()->back()->with('bidStatus', 'თქვენ უკვე გაგზავნეთ რეზიუმე ამ ვაკანსიაზე');
        }
        if($request->user()->id)
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:vacancy,id",
            "video_id"=>"required|exists:videos,id",
        ],[
            'video_id.required'=>'გთხოვთ აირჩიოთ ვიდეო'
        ]);
        $vacancy = Vacancy::findOrFail($request->get('id'));

        $bid = new Bid();
        $bid->user_id = $request->user()->id;
        $bid->vacancy_id = $request->get('id');
        $bid->video_id = $request->get('video_id');
        $bid->to_id = $vacancy->user->id;
        $bid->save();


        $notification = new Notification();
        $notification->user_id = $vacancy->user->id;
        $notification->bid_id = $bid->id;
        $notification->save();
        return redirect('/profile');
    }
}
