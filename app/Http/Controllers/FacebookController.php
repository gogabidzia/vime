<?php

namespace App\Http\Controllers;

use Socialite;
use App\User;
use Auth;
class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $checkUser = User::where('email', $user->email )->first();
        if($checkUser !== null ){
        	Auth::login($checkUser);
        }
        else{
			$newUser = User::create([
	            "email" => $user->email,
	            "name" => $user->name,
	            "logo" => $user->avatar,
	            "type" => "user"
	        ]);
	        Auth::login($newUser);
        }
        if($user->name == 'Geörg Labadze'){
        	return redirect('/profile')->with('labadzstatus', 'ყოჩაღ ლაბაძე მალადეც');
        }
        if($user->name == 'Nika Chiqovani'){
        	return redirect('/profile')->with('labadzstatus', 'ყოჩაღ ჩიქო მალადეც');
        }
        return redirect('/profile');
    }
}