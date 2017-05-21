<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Company as Company;
class AuthController extends Controller
{
    public function register(){
    	return view('auth.register');
    }
    public function login(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
        if (Auth::attempt(['email'=>$request->get('email'), 'password'=>$request->get('password')])) {
                $user = Auth::user();
                if($request->ajax()){
                    return response([
                        "status" => "success"
                    ], 201);
                }
                return redirect('/');
            }
        if($request->ajax()){
            return response([
                "status" => "error"
            ], 401);
        }
        return redirect()->back();
        
    }
    public function postRegister(Request $request){
    	if($request->get('isuser')){
    		$this->validate($request, [
    			"name" => "required",
    			"surname" => "required",
    			"phone"=>"required|min:7|numeric",
	            "email" => "required|email|unique:users,email",
                "password" => "required|min:6",
	        ],[
                'name.required'=> 'გთხოვთ შეიყვანოთ სახელი',
                'surname.required'=> 'გთხოვთ შეიყვანოთ გვარი'
            ]);
            
            $user = User::create([
	            "email" => $request->get('email'),
	            "password" => bcrypt($request->get('password')),
	            "name" => $request->get('name'),
    			"surname" => $request->get("surname"),
    			"phone"=>$request->get("phone")
	        ]);
	        Auth::login($user);
            return redirect('/');
    	}
    	elseif($request->get('iscompany')){
    		$this->validate($request, [
                "name" => "required",
                "phone"=>"required|min:7|numeric",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:6",
            ]);
            $user = User::create([
                "email" => $request->get('email'),
                "password" => bcrypt($request->get('password')),
                "name" => $request->get('name'),
                "phone"=>$request->get("phone")
            ]);
            $company = new Company();
            $company->user_id = $user->id;
            $company->save();
            Auth::login($user);
            return redirect('/');
    	}
        return redirect()->back();
    }
    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
