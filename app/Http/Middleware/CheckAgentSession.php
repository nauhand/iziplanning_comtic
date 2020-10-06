<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAgentSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Si la session existe sur une autre route alors il faut la supprimer
        // dd($request->is('agents/ajouter/*'));
        if($request->is('gestion-des-agents/ajouter-un-agent/*')==false){
            if ($request->session()->get('agent')) {
                $request->session()->remove('agent');
            }
        }

        return $next($request);
    }
}
