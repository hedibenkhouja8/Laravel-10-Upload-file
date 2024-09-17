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

            // Mise à jour du profil

    public function update(Request $request, $id)
    {
        try {
          //  $data = $request->all();
          //  dd($request->all());

            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'statut' => 'required|in:inactif,en_attente,actif',
                'image' => 'nullable|file|image|max:2048',
            ]);
    
            $profil = Profil::find($id);
    
            if (!$profil) {
                return response()->json(['message' => 'Profile not found'], 404);
            }
    
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }
    
            $profil->update($validatedData);
    
            return response()->json(['message' => 'Profil mis à jour', 'profil' => $profil], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la modification du profil',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        // Check if the authenticated user is available
      

        // Find the profile by ID
        $profil = Profil::find($id);

        if (!$profil) {
            return response()->json(['message' => 'Profil n\'existe pas'], 404);
        }

        // Delete the profile
        $profil->delete();

        return response()->json(['message' => 'profil supprimé'], 200);
    }
}
