<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
class LoginWithGithubController extends Controller
{
    //
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

                $newUser = User::updateOrCreate([
                    'github_id' => $githubUser->id,
                ], [
                    'name' => $githubUser->name,
                    'email' => $githubUser->email,
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('posts');
            
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
