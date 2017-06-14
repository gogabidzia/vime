<?php

namespace App\Http\Controllers;

use Socialite;
use App\User;
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
		$newUser = User::create([
            "email" => $user->email,
            "name" => $user->name,
            "logo"=>$user->avatar,
            "type"=>"user"
        ]);
        Auth::login($newUser);
        return redirect('/profile');
    }
}