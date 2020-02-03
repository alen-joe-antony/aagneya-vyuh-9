<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\UserLevel;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    function index()
    {
     return view('login');
    }

    function auth_redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    function auth_callback($provider)
    {
      $getInfo = Socialite::driver($provider)->user();
      $user = $this->createUser($getInfo,$provider);
      auth()->login($user);
      return redirect('game');

    }

    function createUser($getInfo,$provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $profile_pic = file_get_contents($getInfo->getAvatar());
            File::put(public_path() . '/images/profile-pics/' . $getInfo->getId() . ".jpg", $profile_pic);
            $user = User::create([
                'name'              => $getInfo->name,
                'username'          => preg_replace('/\s+/', '', $getInfo->name),
                'email'             => $getInfo->email,
                'provider'          => $provider,
                'provider_id'       => $getInfo->id,
                'profile_pic_url'   => 'images/profile-pics/' . $getInfo->getId() . ".jpg",
                'institution'       => 'GECB', // Change later
            ]);

            UserLevel::create([
                'username'      => preg_replace('/\s+/', '', $getInfo->name),
            ]);
        }
        return $user;
    }

    function logout()
    {
     Auth::logout();
     return redirect('login');
    }
}
