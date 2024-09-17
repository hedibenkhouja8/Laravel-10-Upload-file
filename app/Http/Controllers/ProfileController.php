<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Http\Resources\ProfilResource;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;

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

    public function update(UpdateProfilRequest $request, $id)
    {
        try {
          //  $data = $request->all();
          //  dd($request->all());

          $validatedData = $request->validated();
    
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
    
    //Supression d'un profil
    public function destroy($id)
    {
      

        $profil = Profil::find($id);

        if (!$profil) {
            return response()->json(['message' => 'Profil n\'existe pas'], 404);
        }

        $profil->delete();

        return response()->json(['message' => 'profil supprimé'], 200);
    }
}
