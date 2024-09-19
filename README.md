<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Liste des Endpoints:

- api/login : ENDPOINT d'authentification.
- api/logout : ENDPOINT de déconnexion.
- api/profils/actifs : ENDPOINT Liste des profils actis sans  ou avec statut 
- api/profil : ENDPOINT Création d'un profil 
- api/profil/{id} : ENDPOINT de Suppression ou de Modification d'un profil

  Rq: N'oubliez pas d'utiliser POST avec ?_method=PUT à la fin d'url quand vous tester la modification d'un profil avec Postman

  Controllers : AuthController / ProfileController <br>
  Middleware : Authenticate / OptionalAuthenticate <br>
  Requests : LoginRequest / UpdateProfilRequest / StoreProfilRequest <br>
  Ressources : ProfilRessource <br>
  Models : Administrateur / Profil <br>
  Factories : ProfilFactory / AdministrateurFactory <br>
  Seeders : AdministrateurSeeder / ProfilSeeder <br>
  Tests : AuthControllerTest / ProfilControllerTest
