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

        $userArray = explode(' ' , $user->name);
        dd($userArray);
  // 		$newUser = User::create([
		// 	'name'=>
		// ]);
    }
}