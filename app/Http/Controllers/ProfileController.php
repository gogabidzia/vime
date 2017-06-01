<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use Image;
use File;
use App\Video;
use App\Bid;
use App\SavedVacancy;
use Response;
use DB;
class ProfileController extends Controller
{
    public function profile(Request $request){
        if($request->user()->company){
            $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->limit(10)->get();
            $incoming = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->limit(5)->get();
            return view('app.user.profilecompany', ['vacancies' => $vacancies, 'incoming'=>$incoming]);
        }else{
            $bids = $request->user()->bids()->orderBy('created_at','desc')->limit(7)->get();
            $saved = $request->user()->savedvacancies()->orderBy('created_at','desc')->where('type', 'vacancy')->limit(7)->get();
            return view('app.user.profileuser', ['bids'=>$bids, 'saved'=>$saved]);
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
    public function videos(Request $request){
        if(!$request->user()->company){
            $videos = $request->user()->videos()->where('type', '=', 'visume')->orderBy('created_at','desc')->get();
            $fvideos = $request->user()->videos()->where('type', '=', 'facecontrol')->orderBy('created_at','desc')->get();

            return view('app.user.videos', ['videos'=>$videos, 'fvideos'=>$fvideos]);
        }
    }
    public function removeVideo($id){
        $video = Video::findOrFail($id);
        $link = $video->link;
        Storage::delete('/resumes/'.$link);
        if(Auth::user()->id == $video->user->id){
            $video->delete();
            return redirect()->back();
        }
    }
    public function allvacancies(Request $request){
        $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->paginate(15);
        return view('app.user.allvacancies', ['vacancies'=>$vacancies]);
    }
    public function allincoming(Request $request){
        $incoming = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->paginate(15);
        return view('app.user.allincoming', ['incoming'=>$incoming]);
    }

    public function allbids(Request $request){
            $bids = $request->user()->bids()->orderBy('created_at','desc')->limit(7)->get();
            $saved = $request->user()->savedvacancies()->orderBy('created_at','desc')->limit(7)->get();
            return view('app.user.profileuser', ['bids'=>$bids, 'saved'=>$saved]);
    }
    public function allsaved(Request $request){
        $incoming = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->paginate(15);
        return view('app.user.allsaved', ['incoming'=>$incoming]);
    }

    public function changePass(Request $request){
        $this->validate($request, [
            "password" => "required|min:6|confirmed"
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect('/profile');
    }
    public function uploadlogo(Request $request){
        $this->validate($request, [
            "logo" => "image|max:1000"
        ], [
            'logo.image'=>"ფაილი უნდა იყოს სურათის ტიპის",
            'logo.max'=>"სურათის ზომა არ უნდა აღემატებოდეს 1MB - ს"
        ]);
        $request->file('logo')->storeAs('comp_logos', $request->user()->id .".". $request->file('logo')->extension());

        $user  = $request->user();
        $user->logo = '/logos/'.$request->user()->id .".". $request->file('logo')->extension();
        $user->save();
        return redirect()->back();
    }
    public function uploadVideo(Request $request){
        $this->validate($request, [
            "video" => "required|mimetypes:video/mp4,video/x-msvideo,video/x-ms-wmv,video/quicktime,video/x-flv,video/webm|max:20000"
        ], [
            'video.mimetypes'=>"გთხოვთ აირჩიოთ სწორი ტიპის ვიდეო",
            'video.max'=>"ვიდეოს ზომა არ უნდა აღემატებოდეს 20MB - ს",
            'video.required'=>"გთხოვთ აირჩიოთ ვიდეო",
            'video.uploaded'=>"სამწუხაროდ ვიდეო ვერ აიტვირთა. გთხოვთ სცადოთ თავიდან ან ატვირთოთ სხვა ვიდეო."
        ]);
            $randStr = str_random(32);
            $request->file('video')->storeAs('resumes', $randStr .".". $request->file('video')->extension());

            $video = new Video();
            $video->user_id = $request->user()->id;
            $video->link = $randStr . "." . $request->file('video')->extension();
            if($request->get('type')=="visume"){
                $video->type="visume";
            }
            if($request->get('type')=='facecontrol'){
                $video->type = "facecontrol";
            }
            $video->save();
            return redirect('/profile/videos')->with('uploadStatus', 'ვიდეო წარმატებით აიტვირთა');

    }
    public function getImage($image){
        if(!File::exists( $image=storage_path("app/comp_logos/{$image}") )) abort(404);

        return Image::make($image)->response();
    }
    public function getVideo($name){
        $filePath = storage_path() ."/app/resumes/".$name;
        if (!File::exists($filePath)) {
                return Response::make("File does not exist.", 404);
            }
        return response()->download($filePath);
    }

    public function readNotifications(Request $request){
        $notifications = DB::table('notifications')->where('user_id', '=', $request->user()->id);
        $notifications->delete();
    }
    public function saveVacancy($id, Request $request){
        $saved = new SavedVacancy();
        $saved->user_id = $request->user()->id;
        $saved->vacancy_id = $id;
        $saved->type="vacancy";
        $saved->save();
        return redirect()->back();
    }
}
