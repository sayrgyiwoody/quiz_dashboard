<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $existingUser = User::where('email', $socialUser->email)->first();

            if ($existingUser && $existingUser->provider !== $provider) {
                return redirect(env('FRONTEND_URL') . '/socialite-callback/error?message=This email is already used by different method to login.');
            }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $socialUser->id,
            ])->first();

            if(!$user){
                $user = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'provider_token' => $socialUser->token,
                    'provider_refresh_token' => $socialUser->refreshToken,
                    'provider_avatar' => $socialUser->avatar,
                    'provider_id' => $socialUser->id,
                    'provider' => $provider,
                    'email_verified_at' => now()
                ]);
            }

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
