<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Administrateur;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
  
    //Test login
    public function test_login_with_valid_credentials()
    {
        // Création d'un administrateur
$email='user' . uniqid() . '@example.com'; 
        $password = 'password123';
       Administrateur::factory()->create([
            'email' => $email,
            'password' => bcrypt($password), 
        ]);

        $data = [
            'email' => $email,
            'password' => $password,
        ];

        $response = $this->postJson('/api/login', $data);

        // Vérifications de la réponse
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type',
                     'user' => [
                         'id',
                         'email',
                         'nom',
                         'prenom'
                     ]
                 ]);

        // Vérifier que le token est généré
        $this->assertNotNull($response->json('access_token'));
    }
}
