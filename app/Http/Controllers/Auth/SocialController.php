<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Traits\ActivationTrait;
use App\Social;
use App\User;
use Mockery\Exception;

class SocialController extends Controller
{
    use ActivationTrait;

    public function getSocialRedirect( $provider )
    {

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error','No such provider');

        }

        return Socialite::driver( $provider )->redirect();

    }

    public function getSocialHandle( $provider )
    {

        if (Input::get('denied') != '') {

            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');

        }

        $user = Socialite::driver( $provider )->user();

        $socialUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {

            $socialUser = $userCheck;

        }
        else {

            $sameSocialId = Social::where('social_id', '=', $user->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {

                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email              = $email;
                $name = explode(' ', $user->name);

                $newSocialUser->name = $user->name;

                $newSocialUser->password = bcrypt(str_random(16));
                $newSocialUser->token = str_random(64);
                $newSocialUser->activated = true; //!config('settings.activation');
                $newSocialUser->save();

                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider= $provider;
                
                $newSocialUser->social()->save($socialData);
                // $socialData->user_id = $newSocialUser->id;
                // $socialData->save();
            
            

                $this->initiateEmailActivation($newSocialUser);

                $socialUser = $newSocialUser;

            }
            else {

                //Load this existing social user
                $socialUser = $sameSocialId->user;

            }

        }

        auth()->login($socialUser, true);

        if (Auth::check()){
            return redirect('/dashboard')->with('success', 'Logged in successfully');
        } 

        return abort(500, 'Error logging in');

    }
}
