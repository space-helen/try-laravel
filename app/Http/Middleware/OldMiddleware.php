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
        /*不確定怎麼使用input 目前以下呼叫方式 $request->input('_age') 都是空
        if ($request->input('_age') <= 20) {
            return redirect('/');
        }
        */
        echo 'age: '.$request->_age.'<br/>';
        if($request->_age < 20){
            echo '未成年<br/>';
        }

        return $next($request);
    }
}
