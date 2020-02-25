<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
      if($user->username == Null) // or $user->home_participant == Null or $user->institution == Null
      {
          return view('register')->with('provider', $provider)->with('id', $getInfo->id)->with('name', $getInfo->name);
      }
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
                'email'             => $getInfo->email,
                'provider'          => $provider,
                'provider_id'       => $getInfo->id,
                'profile_pic_url'   => 'images/profile-pics/' . $getInfo->getId() . ".jpg",
            ]);
        }
        return $user;
    }

    function registerUser(Request $request) {
        $v = Validator::make($request->all(), [
            'name'          => 'required|regex:/^[a-zA-Z\s]*$/',
            'username'      => 'unique:users|required|min:3|regex:/^[\w\\s]+$/',
            'institution'   => 'required|regex:/^[\w\\s]+$/'
        ]);

        if ($v->fails())
        {
            return view('register')->withErrors($v->errors())->with('provider', $request->provider)->with('id', $request->id)->with('name', $request->name);
        }
        $user = User::where('provider_id', $request->id)->first();
        $user->update([
            'name'              => $request->name,
            'username'          => $request->username,
            'home_participant'  => $request->home_participant,
            'institution'       => $request->institution
        ]);
        UserLevel::create([
            'username'          => $request->username
        ]);
        return redirect('game');
    }

    function logout()
    {
     Auth::logout();
     return redirect('login');
    }
}
