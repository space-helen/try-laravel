<?php
//------------ create by helen 2019-10-21------------
namespace App\Http\Middleware;

use Closure;

class OldMiddleware
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
        if ($request->input('_age') <= 20) {
            echo $request->input('_age');
            //return redirect('/');
        }

        return $next($request);
    }
}
