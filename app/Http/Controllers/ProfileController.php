<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfilRequest;

class ProfileController extends Controller
{
    public function store(StoreProfilRequest $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Not authenticated hedi'], 401);
        }
    
        return response()->json(['message' => 'Authenticated', 'user' => $user], 200);
    
        try {

     

        // Téléchargement du fichier
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Création du  profil
        $profil = Profil::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'image' => $imagePath ?? null,
            'statut' => $request->statut,
        ]);

        return response()->json($profil, 201);
            } 
            
            catch (\Exception $e) {
        return response()->json([
            'message' => 'Erreur lors de la création du profil',
            'error' => $e->getMessage(),
        ], 500);
    }
    }
}
