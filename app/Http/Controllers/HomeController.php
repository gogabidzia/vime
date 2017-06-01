<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::orderBy('created_at','desc')->where('type','vacancy')->paginate(15);
        return view('app.home', ['vacancies'=> $vacancies]);
    }
    public function subscribe(){
        return redirect()->back();   
    }
    
}
