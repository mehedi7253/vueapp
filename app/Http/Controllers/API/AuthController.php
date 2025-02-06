<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        try {
            $user = new User();
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'message' => 'User Registered Successfully!',
                'user' => $user,
            ], 201);

        }
        catch (\Exception $ex) {
            return response()->json([
                'error' => 'Unable to save the user record, please refresh webpage and try again. If still problem persists contact with administrator'
            ], 401);
        }
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => 'The provided credentials are incorrect.'
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function checkUserStatus()
    {
        $status = auth()->check() ? true: false;
        return response()->json([
            'status' => $status
        ], 200);

    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => 'User logged out'
        ], 201);

    }

    public function profileUpdate(Request $request)
    {
       $user = Auth::user();
       $user->update($request->all());

       return response()->json([
            'message' => 'User update successful'
        ], 201);
    }
}
