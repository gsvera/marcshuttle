<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class LangMiddleware
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
            
            if(request()->session()->get('lang') != null) 
            {
                App::setLocale(request()->session()->get('lang'));
            }
            return $next($request);
        }
        catch(Exception $e)
        {
            error_log($e->getMessage());
        }
    }
}
