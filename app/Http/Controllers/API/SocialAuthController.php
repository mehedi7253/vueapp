<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            // Find or create the user
            $user = User::updateOrCreate([
                'email' => $socialUser->getEmail(),
            ], [
                'name' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);

            // Generate Sanctum token
            $token = $user->createToken('auth_token')->plainTextToken;

            // Redirect user to frontend with the token
            return redirect()->to(env('FRONTEND_URL') . '/auth/callback?token=' . $token);

        } catch (\Exception $e) {
            return redirect()->to(env('FRONTEND_URL') . '/auth/callback?error=Unauthorized');
        }
    }


    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
