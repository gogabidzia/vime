<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use Auth;
use App\Company as Company;
use Mail;
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
    			"name" => "required|alpha",
    			"surname" => "required|alpha",
    			"phone"=>"required|min:7|numeric",
	            "email" => "required|email|unique:users,email",
                "password" => "required|min:6",
                "acceptterms"=>"required"
	        ],[
                'name.alpha'=>'სახელი არ უნდა შეიცავდეს რიცხვებს და გამოტოვებებს',
                'surname.alpha'=>'გვარი არ უნდა შეიცავდეს რიცხვებს და გამოტოვებებს',
                'name.required'=> 'გთხოვთ შეიყვანოთ სახელი',
                'surname.required'=> 'გთხოვთ შეიყვანოთ გვარი',
                'phone.required'=>'გთხოვთ შეიყვანოთ ნომერი',
                'phone.min'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'phone.numeric'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'email.required'=>'გთხოვთ შეიყვანოთ ელ.ფოსტა',
                'email.email'=>'გთხოვთ შეიყვანოთ ვალიდური ელ.ფოსტა',
                'email.unique'=>'ასეთი ელ.ფოსტა უკვე დარეგისტრირებულია.',
                'password.unique'=>'გთხოვთ შეიყვანოთ პაროლი.',
                'password.min'=>'პაროლი უნდა შეიცავდეს მინიმუმ 6 სიმბოლოს',
                'acceptterms.required'=>"გთხოვთ დაეთანხმოთ წესებსა და პირობებს"
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
                "identify" => "required|max:10",
                "acceptterms"=>"required"
            ],[
                'name.required'=> 'გთხოვთ შეიყვანოთ სახელი',
                'phone.required'=>'გთხოვთ შეიყვანოთ ნომერი',
                'phone.min'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'phone.numeric'=>'გთხოვთ შეიყვანოთ სწორი ნომერი',
                'email.required'=>'გთხოვთ შეიყვანოთ ელ.ფოსტა',
                'email.email'=>'გთხოვთ შეიყვანოთ ვალიდური ელ.ფოსტა',
                'email.unique'=>'ასეთი ელ.ფოსტა უკვე დარეგისტრირებულია.',
                'password.unique'=>'გთხოვთ შეიყვანოთ პაროლი.',
                'password.min'=>'პაროლი უნდა შეიცავდეს მინიმუმ 6 სიმბოლოს',
                'identify.required' => 'გთხოვთ შეიყვანოთ საიდენტიფიკაციო კოდი',
                'identify.max' => 'საიდენტიფიკაციო კოდი არ უნდა აღემატებოდეს 10 სიმბოლოს',
                'acceptterms.required'=>"გთხოვთ დაეთანხმოთ წესებსა და პირობებს"
            ]);
            $user = User::create([
                "email" => $request->get('email'),
                "password" => bcrypt($request->get('password')),
                "name" => $request->get('name'),
                "phone"=>$request->get("phone"),
                "identify"=>$request->get("identify"),
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
    public function remember(){
        return view('auth.remember');
    }
    public function postRemember(Request $request){
        $this->validate($request, [
            'email'=>'required'
        ],[
            'email.required'=>'გთხოვთ შეიყვანოთ ელ.ფოსტა'
        ]);
        $user = User::where("email", $request->get('email'))->first();
        if(!$user){
            return redirect()->back()->with('status', 'ასეთი მომხმარებელი არ მოიძებნა');
        }
        else{
            $id = $user->id;
            $email = $user->email;
            $token = $user->remember_token;
            $linkToSend = 'http://vime.ge/remember/'.$id.'/'.$token;
            Mail::send('app.emails.remember', ['linkToSend'=>$linkToSend], function ($message) use ($email) {
                $message->from('vimesume@gmail.com', 'Vime');
                $message->to($email);
                $message->subject('პაროლის აღდგენა');
            });
            return redirect('/remember/sent')->with(['email'=>$email]);
        }
    }
    public function rememberSent(){
        return view('auth.remembersent');
    }
    public function rememberChange($id, $token){
        $user = User::findOrFail($id);
        if(!$user){return;}
        if($user->remember_token!==$token){return;}
        else{
            return view('auth.rememberchange', ['token'=>$token, 'id'=>$user->id]);
        }
    }
    public function rememberChangePost(Request $request){
        $user = User::findOrFail($request->get('id'));
        $userToken = $user->remember_token;
        $token = $request->get('token');
        $this->validate($request, [
            'password'=>'min:6|confirmed',
            'token'=>'in:'.$userToken
        ],[
            'password.min'=>'პაროლი უნდა შეიცავდეს მინიმუმ 6 სიმბოლოს',
            'password.confirmed'=>'პაროლები არ ემთხვევა',
            'token.in'=>'არასწორი პარამეტრები'
        ]);
        $user->password = bcrypt($request->get('password'));
        $user->save();
        Auth::login($user);
        return redirect('/profile');
    }
    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
