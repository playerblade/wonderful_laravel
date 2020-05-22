<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $role)
    {
        if ($request->user()->hasRole($role) == 'administrador') {
            return $next($request);
        }elseif($request->user()->hasRole($role) == 'colaborador'){
            return $next($request);

        }elseif($request->user()->hasRole($role) == 'usuario'){
            return $next($request);

        }elseif($request->user()->hasRole($role) == 'verificador'){
            return $next($request);

        }elseif($request->user()->hasRole($role) == 'cliente'){
            return $next($request);
        }else{
            return redirect('/','not allowed');
        }
    }
}
