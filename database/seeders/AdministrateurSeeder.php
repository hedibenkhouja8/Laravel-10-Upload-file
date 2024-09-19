<?php

namespace Database\Seeders;

use App\Models\Administrateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdministrateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrateur::create([
            'nom'     => 'Admin',
            'prenom'  => 'Hedi',
            'email'    => 'hedibenkhouja@gmail.com',
            'password' => Hash::make('123456789'), 
        ]);
    }
}
