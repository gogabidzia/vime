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
                if($user->type=="admin"){
                    return redirect('/admin');
                }
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
                'surname.required'=> 'გთხოვთ შეიყვანოთ გვარი',
                'phone.required'=>'გთხოვთ შეიყვანოთ ნომერი',
                'phone.min'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'phone.numeric'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'email.required'=>'გთხოვთ შეიყვანოთ ელ.ფოსტა',
                'email.email'=>'გთხოვთ შეიყვანოთ ვალიდური ელ.ფოსტა',
                'email.unique'=>'ასეთი ელ.ფოსტა უკვე დარეგისტრირებულია.',
                'password.unique'=>'გთხოვთ შეიყვანოთ პაროლი.',
                'password.min'=>'პაროლი უნდა შეიცავდეს მინიმუმ 6 სიმბოლოს'
            ]);
            
            $user = User::create([
	            "email" => $request->get('email'),
	            "password" => bcrypt($request->get('password')),
	            "name" => $request->get('name'),
    			"surname" => $request->get("surname"),
    			"phone"=>$request->get("phone"),
                "type"=>"user"
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
            ],[
                'name.required'=> 'გთხოვთ შეიყვანოთ სახელი',
                'phone.required'=>'გთხოვთ შეიყვანოთ ნომერი',
                'phone.min'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'phone.numeric'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'email.required'=>'გთხოვთ შეიყვანოთ ელ.ფოსტა',
                'email.email'=>'გთხოვთ შეიყვანოთ ვალიდური ელ.ფოსტა',
                'email.unique'=>'ასეთი ელ.ფოსტა უკვე დარეგისტრირებულია.',
                'password.unique'=>'გთხოვთ შეიყვანოთ პაროლი.',
                'password.min'=>'პაროლი უნდა შეიცავდეს მინიმუმ 6 სიმბოლოს'
            ]);
            $user = User::create([
                "email" => $request->get('email'),
                "password" => bcrypt($request->get('password')),
                "name" => $request->get('name'),
                "phone"=>$request->get("phone"),
                "type"=>"company"
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
