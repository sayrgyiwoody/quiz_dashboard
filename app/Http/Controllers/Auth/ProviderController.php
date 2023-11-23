<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    //
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = User::updateOrCreate(
                [
                    'provider_id' => $socialUser->id,
                    'provider' => $provider,
                ],
                [
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'provider_token' => $socialUser->token,
                    'provider_refresh_token' => $socialUser->refreshToken,
                    'provider_avatar' => $socialUser->avatar
                ]
            );

             // Create a personal access token
             $token = $user->createToken('SocialiteToken')->plainTextToken;

             // Include the user ID and token in the redirect URL
             $redirectUrl = env('FRONTEND_URL') . '/socialite-callback/' . $user->id . '?token=' . $token;

             return redirect($redirectUrl);

        } catch (\Exception $e) {
            return redirect(env('FRONTEND_URL') . '/socialite-callback/error');
        }
    }
}
