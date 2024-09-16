<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    
        return null;
    }
    
    protected function unauthenticated($request, array $guards)
{
    abort(response()->json(['message' => 'Unauthenticated.'], 401));
}

}
