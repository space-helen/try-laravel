<?php
//------------ create by helen 2019-10-18------------
namespace App\Http\Middleware;

use Closure;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    /*
    public function handle($request, Closure $next)
    {
        // Perform action       //先執行任務  
        echo 'before'.'<br/>';
        return $next($request);
    }
    */
    
    public function handle($request, Closure $next, $_var)
    {
        // Perform action       //先執行任務  
        echo 'before'.'<br/>'.$_var.'<br/>';
        return $next($request);
    }
}
