<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Verifica
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()){
            /*if(auth()->user()->situacao == 0){
                Session::invalidate();
                Session::regenerateToken();
                Session::flush();
                Auth::logout();
                return redirect()->route('login')->with('message_fail', "Seu usuário ainda não foi liberado, verifique seu email.");
            }*/
        }


        return $next($request);
    }
}
