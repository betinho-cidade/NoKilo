<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TermoPrivacidade extends Middleware
{

    public function handle($request, Closure $next, $guard = null)
    {

        $user = Auth()->User();

        if($user){
            $status = ($user->privacidade && $user->privacidade == 'S') ? true : false;

            if(!$status){

                return redirect()->route('cliente.show', ['user' => $user, 'termo' => 'aceitar' ]);
            }
        }

        return $next($request);
    }
}
