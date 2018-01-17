<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Vacancy;
use Storage;
use Image;
use File;
use App\Video;
use App\Bid;
use App\SavedVacancy;
use Response;
use DB;
use Carbon\Carbon;
class ProfileController extends Controller
{

    public function __construct(){
        $dateTime = Carbon::now('Asia/Tbilisi');     
            DB::table('vacancies')->where('date_to','<',$dateTime)->delete();
    }

    public function profile(Request $request){
        if($request->user()->company){
            $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->where('type','vacancy')->limit(10)->get();
            $events = $request->user()->vacancies()->orderBy('created_at', 'desc')->where('type','facecontrol')->limit(10)->get();
            $incomingvac = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->where('type','vacancy')->limit(5)->get();
            $incomingfac = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->where('type','facecontrol')->limit(5)->get();
            return view('app.user.profilecompany', ['vacancies' => $vacancies,'events'=>$events, 'incomingvac'=>$incomingvac,
                'incomingfac'=>$incomingfac
                ]);
        }else{
            $bids = $request->user()->bids()->orderBy('created_at','desc')->limit(7)->where('type', 'vacancy')->get();
            $facecontrols = $request->user()->bids()->orderBy('created_at','desc')->limit(7)->where('type', 'facecontrol')->get();
            $saved = $request->user()->savedvacancies()->orderBy('created_at','desc')->limit(7)->get();
            return view('app.user.profileuser', ['bids'=>$bids, 'saved'=>$saved, 'facecontrols'=>$facecontrols]);
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
        $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->where('type','vacancy')->paginate(15);
        return view('app.user.allvacancies', ['vacancies'=>$vacancies]);
    }
    public function allincoming(Request $request){
        $incoming = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->where('type','vacancy')->paginate(15);
        return view('app.user.allincoming', ['incoming'=>$incoming]);
    }

    public function allbids(Request $request){
        $bids = $request->user()->bids()->where('type','vacancy')->orderBy('created_at','desc')->paginate(15);
        return view('app.user.allbids', ['bids'=>$bids]);
    }
    public function allfc(Request $request){
        $bids = $request->user()->bids()->where('type','facecontrol')->orderBy('created_at','desc')->paginate(15);
        return view('app.user.allfc', ['bids'=>$bids]);
    }
    public function allsaved(Request $request){
        $saved = $request->user()->savedvacancies()->orderBy('created_at','desc')->paginate(15);
        return view('app.user.allsaved', ['saved'=>$saved]);
    }

    public function allevents(Request $request){
        $vacancies = $request->user()->vacancies()->orderBy('created_at', 'desc')->where('type', 'facecontrol')->paginate(15);
        return view('app.user.allvacancies', ['vacancies'=>$vacancies, 'pageType'=>'fc']);

    }
    public function allincomingfc(Request $request){
        $incomingfac = Bid::where('to_id', '=', $request->user()->id)->orderBy('created_at','desc')->where('type','facecontrol')->paginate(15);
        return view('app.user.allincomingfac', ['incomingfac'=>$incomingfac]);
    }
    public function allincomingfcSearch(Request $request){
        $q = Bid::query();
        $q->where('to_id', $request->user()->id);
        // if($request->get('name')){
            // $q->reject()
        // }
    }
    public function changePass(Request $request){
        $this->validate($request, [
            "password" => "required|min:6|confirmed"
        ],[
            "password.required"=>"გთხოვთ შეიყვანოთ პაროლი",
            "password.min"=>"პაროლი უნდა შეიცავდეს მინიმუმ 6 სიმბოლოს",
            "password.confirmed"=>"გთხოვთ დაადასტუროთ პაროლი"
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect('/profile');
    }
    public function uploadlogo(Request $request){
        $this->validate($request, [
            "logo" => "required|image|max:1000"
        ], [
            'logo.required'=>"გთხოვთ აირჩიოთ სურათი",
            'logo.image'=>"ფაილი უნდა იყოს სურათის ტიპის",
            'logo.max'=>"სურათის ზომა არ უნდა აღემატებოდეს 1MB - ს"
        ]);
        $request->file('logo')->storeAs('comp_logos', $request->user()->id .".". $request->file('logo')->extension());

        $user  = $request->user();
        $user->logo = '/logos/'.$request->user()->id .".". $request->file('logo')->extension();
        $user->logopath = $request->user()->id .".". $request->file('logo')->extension();
        $user->save();
        return redirect()->back();
    }
    public function deletelogo(Request $request){
        $user = $request->user();
        $path = $user->logopath;
        $user->logo = "";
        $user->logopath = "";
        $user->save();
        if(File::exists('/comp_logos/'.$path)){
            Storage::delete('/comp_logos/'.$path);
        }
        return redirect()->back();
    }
    public function uploadVideo(Request $request){
        $this->validate($request, [
            "video" => "required|mimetypes:video/mp4,video/x-msvideo,video/x-ms-wmv,video/quicktime,video/x-flv,video/webm|max:400000"
        ], [
            'video.mimetypes'=>"გთხოვთ აირჩიოთ სწორი ტიპის ვიდეო",
            'video.max'=>"ვიდეოს ზომა არ უნდა აღემატებოდეს 400MB - ს",
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
        $isSaved = false;
        $saveds = SavedVacancy::where('user_id', $request->user()->id)->where('vacancy_id', $id)->get();
        if(count($saveds)>0){
            return redirect()->back();
        }
        $saved = new SavedVacancy();
        $saved->user_id = $request->user()->id;
        $saved->vacancy_id = $id;
        $saved->type=1;
        $saved->save();
        return redirect()->back();
    }
    public function removeSavedVacancy($id, Request $request){
        $saved = SavedVacancy::findOrFail($id);
        if($request->user()->id = $saved->user_id){
            $saved->delete();
        }
        return redirect()->back();
    }
    public function editvacancy($id, Request $request){
        $description = DB::table('vacancies')->where('id', $id)->first();
                
        return view('app/user/edit', ['description' => $description]);
    }

    public function editedvacancy($id, Request $request){
        
        $descrp = DB::table('vacancies')->where('id', $id)->update(['description' => $request->get('description')]);

        // $desc = DB::table('vacancies')->where('id',$id)->first();
        // $desc->description = $request->input('description');

        return redirect('/profile')->with('uploadStatus', 'აღწერა წარმატებით შეიცვალა');;
    }
}
