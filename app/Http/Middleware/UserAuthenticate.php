<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {        
        try{
            
            if(!$request->session()->get('user_auth')){
                request()->session()->forget('user_auth');
                
                return redirect('/admin-marcshuttle/login');
            }
            
            return $next($request);
        }catch(Exception $e){
            return "Exception: ".$e->getMessage();
        }
    }
}
