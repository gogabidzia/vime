<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use Image;
use File;
use App\Video;
use Response;
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
    public function videos(Request $request){
        if(!$request->user()->company){
            $videos = $request->user()->videos()->orderBy('created_at','desc')->get();
            return view('app.user.videos', ['videos'=>$videos]);
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
        // dd($request->file('video')->getMimeType());
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
}
