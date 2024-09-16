<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    
    public function login(LoginRequest $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Vérifier si l'utilisateur existe

        $administrateur = Administrateur::where('email', $request->email)->first();

        if (! $administrateur || ! Hash::check($request->password, $administrateur->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les informations sont incorrectes.'],
            ]);
        }

        // Création du Token

        $token = $administrateur->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }

    // Déconnexion pour test

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
