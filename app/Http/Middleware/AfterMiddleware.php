<?php
//------------ create by helen 2019-10-18------------
namespace App\Http\Middleware;

use Closure;

class AfterMiddleware
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
        
        $response = $next($request); //先處理 request （next 本身是閉包，會先處理 request)
        // Perform action            //這裡才執行任務
        echo '</br>'.'after'.'<br/>';
        return $response;
        

        /*
        // 測試 跟before一樣先執行任務  
        echo '</br>'.'after'.'<br/>';
        return $next($request);
        */

    }
}
