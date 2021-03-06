<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use App\Contact;
use App\Bid;
use App\News;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
            $dateTime = Carbon::now('Asia/Tbilisi');     
            DB::table('vacancies')->where('date_to','<',$dateTime)->delete();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::orderBy('created_at','desc')->where('type','vacancy')->paginate(30);
        return view('app.home', ['vacancies'=> $vacancies]);
    }
    public function subscribe(){
        return redirect()->back();   
    }
    public function news($id){
        $item = News::findOrFail($id);
        return view('app.news', ['item'=>$item]);
    }
    public function news_all(){
        $items = News::all();
        return view('app.news_all', ['items'=>$items]);
    }
    public function sendContact(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email',
            'text'=>'required'
        ],[
            'name.required'=>'გთხოვთ შეიყვანოთ სახელი',
            'phone.required'=>'გთხოვთ შეიყვანოთ ნომერი',
            'email.required'=>'გთხოვთ შეიყვანოთ ელ.ფოსტა',
            'email.email'=>'გთხოვთ ნამდვილი ელ-ფოსტა',
            'text.required'=>'გთხოვთ შეიყვანოთ ტექსტი'
        ]);
        $contact = new Contact();
        $contact->name = $request->get('name');
        $contact->phone = $request->get('phone');
        $contact->email = $request->get('email');
        $contact->text = $request->get('text');
        $contact->save();
        return redirect()->back();
    }
    public function about(){
        return view('app.about');
    }
}
