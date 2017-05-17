<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('app.home');
    }
    public function subscribe(){
        return redirect()->back();   
    }
    public function profile(Request $request){
        if($request->user()->company){
            return view('app.user.profilecompany');
        }else{
            return view('app.user.profileuser');
        }
    }
}
