<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Http\Resources\ProfilResource;
use App\Http\Requests\StoreProfilRequest;

class ProfileController extends Controller
{

    //Création de profil 
    public function store(StoreProfilRequest $request)
    {
        $user = $request->user();


        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }
    
    
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

    public function profils_actifs()
    {
        

        $profils = Profil::where('statut', 'actif')->get();

         return ProfilResource::collection($profils);
    }
}
