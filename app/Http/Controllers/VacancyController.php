<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use Validator;
use App\Video;
use App\Bid;
use Carbon\Carbon;
use App\Notification;
class VacancyController extends Controller
{
    public function add(Request $request){

        // public function __construct(){
        //     $dateTime = Carbon::now('Asia/Tbilisi');     
        //     DB::table('vacancies')->where('date_to','<',$dateTime)->delete();
        // }


        if($request->get("type")=='vacancy'){
            $locationArray = ["თბილისი", "აფხაზეთის ა/რ", "აჭარის ა/რ", "გურია", "იმერეთი", "კახეთი", "მცხეთა-მთიანეთი", "რაჭა-ლეჩხუმი, ქვ. სვანეთი", "სამეგრელო-ზემო სვანეთი", "სამცხე-ჯავახეთი", "ქვემო ქართლი", "შიდა ქართლი", "უცხოეთი"];
            $catArray = ["ვაკანსიები", "სტიპენდიები", "ტრენინგები", "ტენდერები", "სხვა"];
            $messages = [
                'position.required'=> "გთხოვთ შეიყვანოთ თანამდებობა",
                'description.required'=>"გთხოვთ შეიყვანოთ აღწერა",
                'location.required'=>'გხოვთ შეიყვანოთ ლოკაცია',
                'date_from.required'=>'გთხოვთ შეიყვანოთ საწყისი თარიღი',
                'date_to.required'=>'გთხოვთ შეიყვანოთ საბოლოო თარიღი',
                'category.required'=>'გთოხვთ შეიყვანოთ კატეგორია',
                'date_from.date'=>'გთოხვთ შეიყვანოთ სწორი თარიღი',
                'date_to.date'=>'გთოხვთ შეიყვანოთ სწორი თარიღი'
            ];
            $this->validate($request, [
                "position" => "required",
                "description" => "required",
                "date_from"=>"required|date",
                "date_to"=>"required|date",
                "location"=>"required|numeric|min:0|max:13",
                "category"=>"required|numeric|min:0|max:4"
            ],$messages);

            $vacancy = new Vacancy();
            $vacancy->user_id = $request->user()->id;
            $vacancy->description = $request->get('description');
            $vacancy->position = $request->get('position');
            $vacancy->date_from = $request->get('date_from');
            $vacancy->date_to = $request->get('date_to');
            $vacancy->type="vacancy";
            $vacancy->location = $locationArray[$request->get('location')];
            $vacancy->category = $catArray[$request->get('category')];
            $vacancy->save();
            return redirect('/profile');
        }
        if($request->get('type')=='event'){
            $messages = [
                'position.required'=> "გთხოვთ შეიყვანოთ სათაური",
                'description.required'=>"გთხოვთ შეიყვანოთ აღწერა",
                'location.required'=>'გხოვთ შეიყვანოთ ლოკაცია'
            ];

            $this->validate($request, [
                "position" => "required",
                "description" => "required",
                "location"=>"required"
            ],$messages);
            $vacancy = new Vacancy();
            $vacancy->user_id = $request->user()->id;
            $vacancy->position = $request->get('position');
            $vacancy->description = $request->get('description');
            $vacancy->location = $request->get('location');
            $vacancy->type = 'facecontrol';
            $vacancy->save();
            return redirect('/profile');
        }
    }
    public function remove(Request $request, $id){
        $vacancy = Vacancy::findOrFail($id);
        if($request->user()->id == $vacancy->user->id){
            $vacancy->delete();
            $vacancy->bids()->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
    public function view($id){
        $vacancy = Vacancy::findOrFail($id);
        if($vacancy->type=="vacancy"){
            return view('app.vacancies.view' , ['vacancy'=>$vacancy]);
        }
        if($vacancy->type=="facecontrol"){
            return view('facecontrol.view', ['event'=> $vacancy]);
        }
    }

    public function bid(Request $request){
        $video = Video::findOrFail($request->get('video_id'));
        if($video && $request->user()->id !== $video->user->id ){
            return redirect()->back();
        }
        $bidded = false;
        $bids = Vacancy::findOrFail($request->input('id'))->bids;
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
            'video_id.required'=>'გთხოვთ აირჩიოთ ვიდეო',
            'id.exists'=>"ვიდეო არ არსებობს"
        ]);
        $vacancy = Vacancy::findOrFail($request->input('id'));

        $bid = new Bid();
        $bid->user_id = $request->user()->id;
        $bid->vacancy_id = $request->input('id');
        $bid->video_id = $request->get('video_id');
        $bid->to_id = $vacancy->user->id;
        $bid->type = "vacancy";
        $bid->save();


        $notification = new Notification();
        $notification->user_id = $vacancy->user->id;
        $notification->bid_id = $bid->id;
        $notification->save();
        return redirect('/profile');
    }
    public function bidOnFaceControl(Request $request){
        $video = Video::findOrFail($request->get('video_id'));
        if($video && $request->user()->id !== $video->user->id ){
            return redirect()->back();
        }
        $bidded = false;
        $bids = Vacancy::findOrFail($request->input('id'))->bids;
        foreach($bids as $bid){
            if($bid->user->id == $request->user()->id){
                $bidded = true;
            }
        }
        if($bidded){
            return redirect()->back()->with('bidStatus', 'თქვენ უკვე გაგზავნეთ ვიდეო ამ ივენთზე');
        }
        if($request->user()->id)
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:vacancy,id",
            "video_id"=>"required|exists:videos,id",
        ],[
            'video_id.required'=>'გთხოვთ აირჩიოთ ვიდეო',
            'id.exists'=>"ვიდეო არ არსებობს"
        ]);
        $vacancy = Vacancy::findOrFail($request->input('id'));

        $bid = new Bid();
        $bid->user_id = $request->user()->id;
        $bid->vacancy_id = $request->input('id');
        $bid->video_id = $request->get('video_id');
        $bid->to_id = $vacancy->user->id;
        $bid->accepted = false;
        $bid->type="facecontrol";
        $bid->save();
        $notification = new Notification();
        $notification->user_id = $vacancy->user->id;
        $notification->bid_id = $bid->id;
        $notification->save();
        return redirect('/profile');
    }

    public function acceptbid($id,Request $request){
        $bid = Bid::findOrFail($id);
        if($bid){
            $bid->accepted = true;
            $bid->save();
            return redirect()->back();
        }
    }
    public function declinebid($id,Request $Request){
        $bid = Bid::findOrFail($id);
        if($bid){
            $bid->accepted = false;
            $bid->save();
            return redirect()->back();
        }
    }
}
