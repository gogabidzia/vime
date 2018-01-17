<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use App\User;
use App\Contact;
use App\News;
use Storage;
class AdminController extends Controller
{
    public function index(){
    	$vacancies = Vacancy::orderBy('created_at','desc')->where('type','vacancy')->limit(5)->get();
    	$events = Vacancy::orderBy('created_at','desc')->where('type','facecontrol')->limit(5)->get();
    	$companies = User::orderBy('created_at', 'desc')->where('type', 'company')->limit(5)->get();
    	$users = User::orderBy('created_at', 'desc')->where('type', 'user')->limit(5)->get();
    	return view('app.admin.index',[
    		'vacancies'=>$vacancies,
    		'events'=>$events,
    		'companies'=>$companies,
    		'users'=>$users
    	]);
    }
    public function removecontact($id){
        if($id == "all"){
            $contacts = Contact::truncate();
        }else{
            $contact = Contact::findOrFail($id);
            $contact->delete();
        }
        return redirect()->back();
    }
    public function removeuser($id){
    	$user = User::findOrFail($id);
    	// dd();
    	foreach($user->videos as $video){
            if($video->link){
    		  Storage::delete('/resums/'.$video->link);  
            }
        }
        if($user->logo){
            Storage::delete('/comp_logos/'.substr($user->logo,7,strlen($user->logo)-6));
        }
    	$user->bids()->delete();
    	$user->company()->delete();
    	$user->vacancies()->delete();
    	$user->videos()->delete();
    	$user->notifications()->delete();
    	$user->savedvacancies()->delete();
    	$user->delete();
    	return redirect()->back();
    }
    public function removevacancy($id){
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->bids()->delete();
        $vacancy->delete();
        return redirect()->back();
    }
    public function users(){
        $users = User::orderBy('created_at', 'desc')->where('type', 'user')->paginate(15);
        return view('app.admin.users', ["users"=>$users]);
    }
    public function companies(){
        $users = User::orderBy('created_at', 'desc')->where('type', 'company')->paginate(15);
        return view('app.admin.companies', ['companies'=>$users]);
    }
    public function vacancies(){
        $vacancies = Vacancy::where('type','vacancy')->orderBy('created_at','desc')->paginate(15);
        return view('app.admin.vacancies' , ['vacancies' => $vacancies]);
    }
    public function events(){
        $events = Vacancy::where('type','facecontrol')->orderBy('created_at','desc')->paginate(15);
        return view('app.admin.events' , ['events' => $events]);

    }
    public function searchusers(Request $request){
        $q = User::query();
        $q->where('type', 'user');
        if($request->get('name')){
            $q->where('name', 'like', "%{$request->get('name')}%");
        }
        if($request->get('surname')){
            $q->where('surname', 'like', "%{$request->get('surname')}%");
        }
        if($request->get('email')){
            $q->where('email', 'like', "%{$request->get('email')}%");
        }
        $users = $q->paginate(15);
        return view('app.admin.users' , ['users' => $users]);
    }
    public function searchcompanies(Request $request){
        $q = User::query();
        $q->where('type', 'company');
        if($request->get('name')){
            $q->where('name', 'like', "%{$request->get('name')}%");
        }
        if($request->get('email')){
            $q->where('email', 'like', "%{$request->get('email')}%");
        }
        if($request->get('phone')){
            $q->where('phone', 'like', "%{$request->get('phone')}%");
        }
        $companies = $q->paginate(15);
        return view('app.admin.companies' , ['companies' => $companies]);
    }
    public function searchvacancies(Request $request){
        $q = Vacancy::query();
        $q->where('type', 'vacancy');

        if($request->get('position')){
            $q->where('position', 'like', "%{$request->get('position')}%");
        }
        if($request->get('date_from')){
            $q->where('date_from', ">=", $request->get('date_from'));
        }
        if($request->get('date_to')){
            $q->where('date_to', "<=", $request->get('date_to'));
        }
        $vacancies = $q->paginate(15);
        return view('app.admin.vacancies' , ['vacancies' => $vacancies]);
    }
    public function searchevents(Request $request){
        $q = Vacancy::query();
        $q->where('type', 'facecontrol');

        if($request->get('position')){
            $q->where('position', 'like', "%{$request->get('position')}%");
        }
        if($request->get('description')){
            $q->where('description', 'like', "%{$request->get('description')}%");
        }
        if($request->get('location')){
            $q->where('location', 'like', "%{$request->get('location')}%");
        }
        $events = $q->paginate(15);
        return view('app.admin.events' , ['events' => $events]);
    }
    public function contact(){
        $contacts = Contact::orderBy('created_at','desc')->paginate(15);
        return view('app.admin.contacts', ['contacts'=>$contacts]);
    }
    public function news(){
        $news = News::all();
        return view('app.admin.news', ['news'=> $news]);
    }
    public function postNews(Request $request){
        $item = new News();
        $item->title = $request->get('title');
        $item->text = $request->get('text');
        $item->position = $request->get('position');

        if($request->file('img')){
            $destinationPath = "news_image";
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(1111,9999).".".$extension;
            $file->move($destinationPath, $filename);
            $photo = $filename;
            $item->img = '/news_image/'.$photo;
        }
        else{
            $item->img='/img/news.png';
        }



        $item->bubbled = false;
        $item->save();
        return redirect()->back();
    }
    public function removeNews($id){
        $item = News::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
    public function makeNewsForBubble($id){
        $items = News::where('bubbled', true)->get();
        foreach ($items as $news) {
            $news->bubbled = false;
            $news->save();
        }
        $item = News::findOrFail($id);
        $item->bubbled = true;
        $item->save();
        return redirect()->back();
    }
}
