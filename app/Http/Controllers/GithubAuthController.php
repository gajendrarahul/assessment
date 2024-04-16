<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirectToGithubLogin()
    {
        return Socialite::driver('github')->redirect();

    }

    public function handleGithubCallback(){
        //get the github user data using socialite package of laravel
        $githubUser = Socialite::driver('github')->user();
        // check if the user already exist if not create new user
        $user = User::firstOrCreate([
                'email' => $githubUser->email],
            [
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email,
                'password' => 'password',
            ]
        );
        // make github user login and redirect to dashboard
        Auth::login($user);
        return redirect('/dashboard');

    }
}
