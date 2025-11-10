<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $loginInput = $request->email;

        $user = User::where('email', $loginInput)
                    ->orWhere('phone', $loginInput)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "Email/Phone ou mot de passe incorrect"
            ], 422);
        }

        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            "message" => "Utilisateur connecté avec succès !",
            "user" => $user,
            "token" => $token
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Déconnecté avec succès.',
        ], 200);
    }
}
