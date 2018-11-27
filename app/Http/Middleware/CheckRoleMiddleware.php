<?php

namespace App\Http\Middleware;

use Closure;
//Importing spatie laravel role model
use Spatie\Permission\Models\Role;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            
            $response['sucess'] = false;
            $response['error'] = 'Unauthorized';
            
            return response($response, 401);
            
        }
        
        return $next($request);
    }
}
