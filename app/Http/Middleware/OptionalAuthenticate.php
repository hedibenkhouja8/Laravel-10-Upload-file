<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class OptionalAuthenticate extends Authenticate
{

    //checker Le bon Guard Si connecté ou Non
    protected function authenticate($request, array $guards)
    {
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);
                return;
            }
        }

       
    }
}
