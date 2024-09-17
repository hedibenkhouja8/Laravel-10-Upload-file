<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Profil;
use App\Models\Administrateur;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
  


    public function test_update_profile()
    {
        Storage::fake('public');

        $user = Administrateur::factory()->create();
        $profil = Profil::factory()->create();

        $image = UploadedFile::fake()->image('avatar.jpg');

        $data = [
            'nom' => 'Test',
            'prenom' => 'Update',
            'statut' => 'actif',
            'image' => $image,
        ];

        $response = $this->actingAs($user)->put("/api/profil/{$profil->id}", $data);

        // Checker la réponse
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Profil mis à jour']);
// Checker modification sur BDD
        $this->assertDatabaseHas('profils', [
            'id' => $profil->id,
            'nom' => 'Test',
            'prenom' => 'Update',
            'statut' => 'actif',
            'image' => 'images/' . $image->hashName(),
        ]);
    }

    public function test_create_profile()
{
    $admin = Administrateur::factory()->create();

    Storage::fake('public');

    $image = UploadedFile::fake()->image('avatar.jpg');

    $data = [
        'nom' => 'Test',
        'prenom' => 'Création',
        'statut' => 'actif', 
        'image' => $image,   
    ];

    $response = $this->actingAs($admin)->postJson('/api/profil', $data);

           // Checker la réponse
         $response->assertStatus(201)
             ->assertJsonStructure([
                 'id',
                 'nom',
                 'prenom',
                 'statut',
                 'image',
                 'created_at',
                 'updated_at',//schema doit etre le meme que la réponse
             ]);
// Checker création sur BDD

    $this->assertDatabaseHas('profils', [
        'nom' => 'John',
        'prenom' => 'Doe',
        'statut' => 'actif',
    ]);

   }

}
